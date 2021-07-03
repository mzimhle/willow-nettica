<?php
/* Add this on all pages on top. */
set_include_path($_SERVER['DOCUMENT_ROOT'].'/'.PATH_SEPARATOR.$_SERVER['DOCUMENT_ROOT'].'/library/classes/');

/**
 * Standard includes
 */
require_once 'config/database.php';
require_once 'config/smarty.php';
require_once 'libpdf/mpdf.php';
require_once 'Zend/Mail.php';

/* objects. */
require_once 'class/invoice.php';
require_once 'class/clientproduct.php';
require_once 'class/client.php';
require_once 'class/invoiceitem.php';
require_once 'class/invoicemonthly.php';
require_once 'pdfcrowd/pdfcrowd.php';

$clientObject					= new class_client();
$invoiceObject				= new class_invoice();
$clientproductObject		= new class_clientproduct();
$invoiceitemObject			= new class_invoiceitem();
$invoicemonthlyObject	= new class_invoicemonthly();
$pdfObject					= new Pdfcrowd("willow_nettica", "6be184b78c92a8da33964db13d079b6e");

/* First of all, get the paying client's details. */
$clientData = $clientObject->getPayingClient();

/* Current Month. */
$currentMonth = date('Y-m');
echo '<b>'.$currentMonth.'</b><br />';

/* Loop through all the paying clients. */
foreach($clientData as $client) {

	echo '=======================================';
	echo '<br /><b>'.$client['client_company'].'</b><br />';
	
	/* Get all other monthly products. */
	$products = $clientproductObject->getMonthly($client['client_reference']);
	
	if(count($products) > 0) {

		$invoiceItem	= array();
		$invoiceTotal	= 0;
		
		for($i = 0; $i < count($products); $i++) {
			$invoiceItem[] = array(
					'invoiceitem_name' 		=> $products[$i]['product_name'],
					'invoiceitem_description'	=> $products[$i]['product_description'],
					'invoiceitem_price'			=> $products[$i]['product_price']
			);
			$invoiceTotal 		+= $products[$i]['product_price'];
		}
		
		$paymentDay	= explode("-", $client['client_payment_date']);
		$paymentDate	= date('Y-m')."-".$paymentDay[2];
		
		/* Get create invoice data. */
		$invoiceData = array();
		$invoiceData['invoice_reference']		= $invoiceObject->createReference();
		$invoiceData['fk_client_reference'] 		= $client['client_reference'];
		$invoiceData['invoice_total']				= $invoiceTotal;
		$invoiceData['invoice_notes']				= '<span style="color: green; font-weight: bold">This is a payment invoice for '.$paymentDate.'</span>';
		$invoiceData['invoice_file']					= '/media/invoices/'.$invoiceData['fk_client_reference'].'/'.$invoiceData['invoice_reference'].'.html';
		$invoiceData['invoice_paid']				= 0;
		$invoiceData['invoice_send_to_client']	= date('Y-m-d');
		$invoiceData['invoice_type']				= 'monthly';
		
		$smarty->assign('client', $client);
		$smarty->assign('invoice', $invoiceData);
		$smarty->assign('products', $invoiceItem);
		$smarty->assign('paymentDate', $paymentDate);
		$html = $smarty->fetch('mailers/invoice/invoice.html');
		
		/* Save file. */
		$directory	= $_SERVER['DOCUMENT_ROOT'].'/media/invoices/'.$invoiceData['fk_client_reference'].'/';
		$filename	= $directory.$invoiceData['invoice_reference'].'.html';
		$pdffile		= $directory.$invoiceData['invoice_reference'].'.pdf';
		
		/* Create directory. */
		if(!is_dir($directory)) mkdir($directory, 0777);
				
		if(file_put_contents($filename, $html)) {
				
			try {
				/* Create pdf file. */
				
				
				$pdfdata = $pdfObject->convertFile($filename);
				
				if(file_put_contents($pdffile, $pdfdata)) {
					echo 'PDF uploaded: <a href="/media/invoices/'.$invoiceData['fk_client_reference'].'/'.$invoiceData['invoice_reference'].'.pdf" target="_blank">Click here to open the file.</a><br />';					
				} else {
					echo 'Could not create pdf: '.$pdffile.'<br />';
				}
		
			} catch(PdfcrowdException $e)  {
				echo "Pdfcrowd Error: " . $e->getMessage();
				exit;
			}
					
				if(is_file($pdffile)) {
					
					$pdf = file_get_contents($pdffile);
					
					foreach($invoiceItem as $item) {
						$invoiceitemdata = array();
						$invoiceitemdata['invoiceitem_name'] 			= $item['invoiceitem_name'];
						$invoiceitemdata['invoiceitem_description']	= $item['invoiceitem_description'];
						$invoiceitemdata['invoiceitem_price']			= $item['invoiceitem_price'];
						$invoiceitemdata['fk_invoice_reference']		= $invoiceData['invoice_reference'];
						$invoiceitemObject->insert($invoiceitemdata);						
					}
					
					$invoiceObject->insert($invoiceData);

					
					$at = $mail = null;
					unset($at, $mail);
										
					$mail = new Zend_Mail();
					
					/* Mailer variables. */
					$smarty->assign('client', $client);
					$smarty->assign('invoiceData', $invoiceData);
					$smarty->assign('title', 'Client Invoice for '.date('F Y'));
					$smarty->assign('clientname', $invoiceData['client_contact_name'].' '.$invoiceData['client_contact_surname']);
					
					$smarty->assign('message', 'Attached is a an invoice for the month of <span style="font-weight: bold; color: red;">'.date('F Y').'.</span> for the client: <span style="font-weight: bold; color: red;">'.$client['client_company'].'</span>. Please use this invoice reference: <span style="font-weight: bold; color: red;">'.$invoiceData['invoice_reference'].'</span> when making payment to the below bank details.');
					
					$smarty->assign('reference', $invoiceData['invoice_reference']);
					$html	= $smarty->fetch('mailers/invoice/send_to_client.html');
		
					
					$at = new Zend_Mime_Part($pdf);
					$at->type				= 'application/pdf';
					$at->disposition		= Zend_Mime::DISPOSITION_ATTACHMENT;
					$at->encoding    	= Zend_Mime::ENCODING_BASE64;
					$at->filename    	= $invoiceData['fk_client_reference'].'-'.$invoiceData['invoice_reference'];
					$mail->addAttachment($at);		
					

					$mail->setFrom('info@willow-nettica.c.za', 'Monthly Invoices');											
					$mail->addTo($client['client_contact_email']);
					$mail->addTo('invoices@willow-nettica.co.za');
					$mail->setSubject('Willow Nettica Monthly Invoice - '.$client['client_company']);
					$mail->setBodyHtml($html);		
					if($mail->send()) {
						echo 'Uploaded file: '.$filename.', send email to : '.$client['client_contact_email'].' - invoices@willow-nettica.co.za<br />';
					} else {
						echo 'Uploaded file: '.$filename.', but could not send email to : '.$client['client_contact_email'].'<br />';
					}
					
					$data = array();
					$data['fk_client_reference'] 			= $client['client_reference'];
					$data['fk_invoice_reference'] 			= $invoiceData['invoice_reference'];
					$data['invoiceMonthly_email'] 		= $client['client_contact_email'];
					$data['invoiceMonthly_fullname'] 	= $client['client_contact_name'].' '.$client['client_contact_surname'];
					$data['invoiceMonthly_file'] 			= '/media/invoices/'.$invoiceData['fk_client_reference'].'/'.$invoiceData['invoice_reference'].'.pdf';
					
					$invoicemonthlyObject->insert($data);
					
				} else {
					echo 'Could not create pdf file : '.$pdffile.' for '.$client['client_company'].'<br />';
				}
		} else {
			echo 'Could not upload file: '.$filename.'<br />';
		}
	} else {
		echo 'No products for '.$client['client_company'].'<br />';
	}
}

echo '<br />END';
?>
