<?php
/* Add this on all pages on top. */
set_include_path($_SERVER['DOCUMENT_ROOT'].'/'.PATH_SEPARATOR.$_SERVER['DOCUMENT_ROOT'].'/library/classes/');

/**
 * Standard includes
 */
require_once 'config/database.php';
require_once 'config/smarty.php';

/* Other resources. */
require_once 'admin/includes/auth.php';

require_once 'class/invoice.php';
require_once 'class/invoiceitem.php';
require_once 'class/invoicefile.php';
require_once 'File.php';

$invoiceObject		= new class_invoice();
$invoiceitemObject	= new class_invoiceitem();
$invoicefileObject	= new class_invoicefile();
$fileObject 			= new File(array('doc', 'docx', 'pdf', 'txt'));

if (!empty($_GET['reference']) && $_GET['reference'] != '') {

	$reference = trim($_GET['reference']);

	$invoiceData = $invoiceObject->getByReference($reference);
	
	if(count($invoiceData) > 0) {
		$smarty->assign('invoiceData', $invoiceData);
	} else {
		header('Location: /admin/invoices/unpaid/');
		exit;
	}
} else {
	header('Location: /admin/invoices/unpaid/');
	exit;
}


/* Check posted data. */
if(isset($_REQUEST['delete']) && (int)trim($_REQUEST['delete']) == 1) {
	
	$errorArray				= array();
	$errorArray['message']	= '';
	$error					= array();
	$errorArray['result']	= 0;
	$data 					= array();
	$formValid				= true;
	$success				= NULL;
	
	if(isset($_GET['filename']) && trim($_GET['filename']) == '') {
		$error[] = 'Please select file to delete';
		$formValid = false;		
	}	
	
	if($formValid && count($error)  == 0 ) {	
		
		$where		= array();
		$where		= $invoicefileObject->getAdapter()->quoteInto('invoiceFile_filename = ?',  trim($_GET['filename']));
		$success	= $invoicefileObject->delete($where);	
				
	}
	
	if(isset($success) && is_numeric($success) && $success > 0) {		
		$errorArray['message']	= '';
		$errorArray['result']	= 1;		
		unlink($_SERVER['DOCUMENT_ROOT']."/media/invoices/".$invoiceData['fk_client_reference'].'/'.trim($_GET['filename']));
		
	} else {
		$errorArray['message']	= 'Could not update, please try again: '.implode(", ", $error);
		$errorArray['result']	= 0;				
	}	
	
	echo json_encode($errorArray);
	exit;
}

$invoiceitemData = $invoiceitemObject->getByInvoiceReference($reference);

if(count($invoiceitemData) > 0)  $smarty->assign('invoiceitemData', $invoiceitemData);


$invoicefileData = $invoicefileObject->getByInvoiceReference($reference);

if(count($invoicefileData) > 0)  $smarty->assign('invoicefileData', $invoicefileData);

/* Check posted data. */
if(count($_POST) > 0) {

	$errorArray		= array();
	$data 			= array();
	$formValid		= true;
	$success		= NULL;
	$errorMessages = '';
	
	if(isset($_POST['invoice_resend']) && (int)trim($_POST['invoice_resend']) == 1) {
		
		require('Zend/Mail.php');
		
		/* Mailer variables. */
		$smarty->assign('title', 'Client Invoice - ref #'.$invoiceData['invoice_reference']);
		$smarty->assign('clientname', $invoiceData['client_contact_name'].' '.$invoiceData['client_contact_surname']);
		$smarty->assign('message', 'As previously discussed, please see attached invoice for services rendered. Also please when making payment, use the reference <span style="font-weight: bold; color: red;">'.$invoiceData['invoice_reference'].'.</span>');
		$smarty->assign('reference', $invoiceData['invoice_reference']);
		$html	= $smarty->fetch('mailers/invoice/send_to_client.html');
		$pdf		= file_get_contents($_SERVER['DOCUMENT_ROOT'].'/media/invoices/'.$invoiceData['fk_client_reference'].'/'.$invoiceData['invoice_reference'].'.pdf');

		$mail = new Zend_Mail();		

		$at = new Zend_Mime_Part($pdf);
		
		$at->type        		= 'application/pdf';
		$at->disposition 	= Zend_Mime::DISPOSITION_ATTACHMENT;
		$at->encoding    	= Zend_Mime::ENCODING_BASE64;
		$at->filename    	= $invoiceData['invoice_reference'];
		$mail->addAttachment($at);
		
		$mail->setFrom('invoices@willow-nettica.c.za', 'Willow Nettica Invoice'); //EDIT!!											
		$mail->addTo($invoiceData['client_contact_email']);
		$mail->addTo('invoices@willow-nettica.co.za');
		$mail->setSubject('Willow Nettica Invoice - '.$invoiceData['client_company']);
		$mail->setBodyHtml($html);		
		if($mail->send()) {
			/* required. */		
			$data['invoice_send_to_client'] =  	date('Y-m-d H:m:s');		
		
			/*Update. */
			$where		= $invoiceObject->getAdapter()->quoteInto('pk_invoice_id = ?', $invoiceData['pk_invoice_id']);
			$success	= $invoiceObject->update($data, $where);
					
			if(is_numeric($success) && $success > 0) {
				header('Location: /admin/invoices/unpaid/');
				exit;		
			}
		} else {
			echo 'Could not send email.'; 
			exit;
		}
	} else if(isset($_POST['invoice_deleted']) && (int)trim($_POST['invoice_deleted']) == 1) {
	
			/* required. */		
			$data['invoice_deleted'] 	= isset($_POST['invoice_deleted']) && (int)trim($_POST['invoice_deleted']) == 1 ? 1 : 0;
		
			/*Update. */
			$where		= $invoiceObject->getAdapter()->quoteInto('pk_invoice_id = ?', $invoiceData['pk_invoice_id']);
			$success	= $invoiceObject->update($data, $where);
					
			if(is_numeric($success) && $success > 0) {
				header('Location: /admin/invoices/unpaid/');
				exit;		
			}
			
	} else {
		if(count($errorArray) == 0 && $formValid == true) {
			
			/* required. */		
			$data['invoice_notes']		= htmlspecialchars_decode(stripslashes(trim($_POST['invoice_notes'])));	
			$data['invoice_paid'] 			= isset($_POST['invoice_paid']) && (int)trim($_POST['invoice_paid']) == 1 ? 1 : 0;				
			$data['invoice_paid_date'] 	= date('Y-m-d H:m:s');
			
			/*Update. */
			$where		= $invoiceObject->getAdapter()->quoteInto('pk_invoice_id = ?', $invoiceData['pk_invoice_id']);
			$success	= $invoiceObject->update($data, $where);
					
			if(is_numeric($success) && $success > 0) {
				/* Check if there are files to upload and update. */
				if(isset($_FILES['invoiceFile']) && (int)$_FILES['invoiceFile']['size'] > 0 && trim($_FILES['invoiceFile']['name']) != '') {
				
					$ext 					= $fileObject->file_extention($_FILES['invoiceFile']['name']);
					$validMimeType	= $fileObject->getValidMimeType('invoiceFile', $ext);
					
					if($validMimeType == '' || trim($_POST['invoiceFile_description']) == '') {
						$errorMessages = 'Document must be .pdf, .doc, docx or .txt or please add a description.';
					} else {
					
						$freference 	= $invoicefileObject->createReference();
						$filename		= $freference.'.'.$ext;
						$directory		= $_SERVER['DOCUMENT_ROOT']."/media/invoices/".$invoiceData['fk_client_reference'];
						$file				= $_SERVER['DOCUMENT_ROOT']."/media/invoices/".$invoiceData['fk_client_reference'].'/'.$filename;
						$tempPath		= "/media/invoices/".$invoiceData['fk_client_reference'].'/'.$filename;		

						/* Create directory. */
						if(!is_dir($directory)) mkdir($directory, 0777);
						
						/* Now lets upload to this directory. */
						if(move_uploaded_file($_FILES['invoiceFile']['tmp_name'], $file)) {
							
							$data = array();
							$data['fk_invoice_reference']		= $invoiceData['invoice_reference'];
							$data['invoiceFile_filename']		= $filename;
							$data['invoiceFile_description']	= trim($_POST['invoiceFile_description']); 
							$data['invoiceFile_path']				= $tempPath;
							
							if(!$invoicefileObject->insert($data)) {
								$errorMessages = 'Could not add file database record.';
							}
						} else {
							$errorMessages = 'Could not upload file.';
						}	
					}					
				}		
				
				if($errorMessages == '') {
					header('Location: /admin/invoices/unpaid/');
					exit;		
				} else {
					$smarty->assign('errorMessages', $errorMessages);
				}
				
			}
		}			
	}
}

/* Display the template  */	
$smarty->display('admin/invoices/unpaid/details.tpl');
?>