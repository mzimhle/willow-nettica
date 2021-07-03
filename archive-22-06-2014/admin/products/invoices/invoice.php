<?php
/* Add this on all pages on top. */
set_include_path($_SERVER['DOCUMENT_ROOT'].'/'.PATH_SEPARATOR.$_SERVER['DOCUMENT_ROOT'].'/library/classes/');

/**
 * Standard includes
 */
require_once 'config/database.php';
require_once 'config/smarty.php';

require_once 'admin/includes/auth.php';

/* objects. */
require_once 'class/client.php';
require_once 'class/invoice.php';
require_once 'class/invoiceitem.php';
require_once 'pdfcrowd/pdfcrowd.php';

$clientObject			= new class_client();
$invoiceObject		= new class_invoice();
$invoiceitemObject	= new class_invoiceitem();

/* Get pairs. */
$clientPairs = $clientObject->pairs();
if(count($clientPairs) > 0) $smarty->assign('clientPairs', $clientPairs);

/* Check posted data. */
if(count($_POST) > 0) {
	
	$error = '';
	
	if(isset($_POST['updateItems'])) {
		if($_POST['invoice_item'] != '' && $_POST['invoice_description'] != '' && $_POST['invoice_price'] != '') {
				$array = array(
						'invoiceitem_name' 			=> $_POST['invoice_item'],
						'invoiceitem_description'	=> $_POST['invoice_description'],
						'invoiceitem_price'			=> $_POST['invoice_price']
				);
				
				$zfsession->invoiceData[] = $array;
						
		} else {
			$smarty->assign('error', 'Please add item, description and price');
		}
	} else if(isset($_POST['addItems'])) {
		
		if(count($zfsession->invoiceData) == 0) {
			$error .= 'Please add items to add.<br />';
		}
		
		if($_POST['fk_client_reference'] == '') {
			$error .= 'Please add a client to invoice.<br />';
		}
		
		if($_POST['due_date'] == '') {
			$error .= 'Please add a due date.';
		} else {
			if($_POST['due_date'] != date('Y-m-d', strtotime($_POST['due_date']))) {
				$error .= 'Please add a valid due date.';
			}
		}
		
		if($error == '') {
			
			$client = $clientObject->getByReference($_POST['fk_client_reference']);
			
			if(count($client ) > 0) {
				/* Invoice insert. */
				$invoiceData = array();
				$invoiceData['invoice_reference']			= $invoiceObject->createReference();
				$invoiceData['fk_client_reference'] 			= $_POST['fk_client_reference'];
				$invoiceData['invoice_type']					= 'onceoff';
				$invoiceData['invoice_notes']					= '';
				$invoiceData['invoice_file']						= '/media/invoices/'.$invoiceData['fk_client_reference'].'/'.$invoiceData['invoice_reference'].'.html';
				$invoiceData['invoice_paid']					= 0;
				$invoiceData['invoice_send_to_client']	= date('Y-m-d');
				
				$total = 0;
				
				foreach($zfsession->invoiceData as $item) {
					$total += $item['invoiceitem_price'];				
				}
				
				$invoiceData['invoice_total']	= $total;
				
				$smarty->assign('client', $client);
				$smarty->assign('invoice', $invoiceData);
				$smarty->assign('products', $zfsession->invoiceData);
				$smarty->assign('paymentDate', $_POST['due_date']);
						
				$html = $smarty->fetch('mailers/invoice/invoice.html');
				
				/* Save file. */
				$directory	= $_SERVER['DOCUMENT_ROOT'].'/media/invoices/'.$invoiceData['fk_client_reference'].'/';
				$filename	= $directory.$invoiceData['invoice_reference'].'.html';
				$pdffile			= $directory.$invoiceData['invoice_reference'].'.pdf';
				
				/* Create directory. */
				if(!is_dir($directory)) mkdir($directory, 0777);
					
				if(file_put_contents($filename, $html)) {

					foreach($zfsession->invoiceData as $item) {
						$invoiceitemdata = array();
						$invoiceitemdata['invoiceitem_name'] 			= $item['invoiceitem_name'];
						$invoiceitemdata['invoiceitem_description']	= $item['invoiceitem_description'];
						$invoiceitemdata['invoiceitem_price']			= $item['invoiceitem_price'];
						$invoiceitemdata['fk_invoice_reference']		= $invoiceData['invoice_reference'];
						$invoiceitemObject->insert($invoiceitemdata);						
					}
					
					$invoiceObject->insert($invoiceData);
					
					try {
						/* Create pdf file. */
						$pdfObject	= new Pdfcrowd("willow_nettica", "6be184b78c92a8da33964db13d079b6e");
						
						$pdfdata = $pdfObject->convertFile($filename);
						
						if(file_put_contents($pdffile, $pdfdata)) {
							$error .= 'PDF uploaded: <a href="/media/invoices/'.$invoiceData['fk_client_reference'].'/'.$invoiceData['invoice_reference'].'.pdf" target="_blank">Click here to open the file.</a><br />';					
						} else {
							$error .= 'Could not create pdf<br />';
						}
				
					} 
						catch(PdfcrowdException $e) 
					{
						echo "Pdfcrowd Error: " . $e->getMessage();
						exit;
					}
					
					/* Send email. 
					require('Zend/Mail.php');
					
					$mail = new Zend_Mail();				
					$mail->setFrom('invoices@willow-nettica.co.za', 'Willow Nettica Invoices'); //EDIT!!													
					//$mail->addTo($client['client_contact_email']);
					$mail->addTo('invoices@willow-nettica.co.za');
					$mail->setSubject('Willow Nettica Invoices - '.$invoiceData['invoice_reference']);
					$mail->setBodyHtml($html);		
					if($mail->send()) {
						$error = 'Uploaded file: <a href="'.$invoiceData['invoice_file'].'">Click here to open the file.</a>, sent email to : '.$client['client_contact_email'].' - invoices@collop.co.za<br />';
						$zfsession->invoiceData = null;
					} else {
						$error = 'Uploaded file: '.$filename.', but could not send email to : '.$client['client_contact_email'].'<br />';
					}
					*/
					$error .= 'Uploaded file: <a href="'.$invoiceData['invoice_file'].'" target="_blank">Click here to open the file.</a><br />';
					//$zfsession->invoiceData = null;
				} else {
					$error = 'Could not upload file: '.$filename.'<br />';
				}
			} else {
				$error = 'Client does not exist.<br />';
			}				
		}

		$smarty->assign('error', $error);
	}
}

if(count($zfsession->invoiceData) > 0) {
	$smarty->assign('invoiceitem', $zfsession->invoiceData);
}

 /* Display the template */	
$smarty->display('admin/products/invoices/invoice.tpl');
?>