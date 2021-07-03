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


/* AJAX. */
if(isset($_REQUEST['delete']) && trim($_REQUEST['delete']) == 1) {
	
	$array['result']			= true;
	$array['message']		= '';
	
	if(isset($zfsession->invoiceData) && count($zfsession->invoiceData) > 0) {
		$deleteItem = trim($_REQUEST['deleteitem']);
		
		if(isset($zfsession->invoiceData[$deleteItem])) {
			
			$tempArray = array();
			$count		= 0; 
			
			unset($zfsession->invoiceData[$deleteItem]);
			
			foreach($zfsession->invoiceData as $item) { 
				$tempArray[] = array(
					'invoiceitem_name' 			=> $item['invoiceitem_name'],
					'invoiceitem_description'	=> $item['invoiceitem_description'],
					'invoiceitem_price'			=> $item['invoiceitem_price']			
				);
			}
			
			$zfsession->invoiceData = array();
			$zfsession->invoiceData = $tempArray;
			
		} else {
			$array['result']	 = false;
			$array['message'] = 'Cannot remove item, it does not exist.';		
		}
	} else {
		$array['result']	 = false;
		$array['message'] = 'There are no items selected.';
	}
	
	echo json_encode($array);
	exit;
}
/* END AJAX. */

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
				$invoiceData['invoice_payment_date']		= trim($_POST['due_date']);
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
						
				$html = $smarty->fetch('templates/invoice/invoice.html');
				
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
					
					$error .= 'Uploaded file: <a href="'.$invoiceData['invoice_file'].'" target="_blank">Click here to open the file.</a><br />';
					$zfsession->invoiceData = null;
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
$smarty->display('admin/invoices/create/default.tpl');
?>