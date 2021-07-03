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

$invoiceObject		= new class_invoice();
$invoiceitemObject	= new class_invoiceitem();

if (!empty($_GET['reference']) && $_GET['reference'] != '') {

	$reference = (int)$_GET['reference'];

	$invoiceData = $invoiceObject->getByReference($reference);
	
	if(count($invoiceData) > 0) {
		$smarty->assign('invoiceData', $invoiceData);
	} else {
		header('Location: /admin/invoices/invoices/');
		exit;
	}
} else {
	header('Location: /admin/invoices/invoices/');
	exit;
}

$invoiceitemData = $invoiceitemObject->getByInvoiceReference($reference);

if(count($invoiceitemData) > 0)  $smarty->assign('invoiceitemData', $invoiceitemData);

/* Check posted data. */
if(count($_POST) > 0) {

	$errorArray		= array();
	$data 			= array();
	$formValid		= true;
	$success		= NULL;
	
	if(isset($_POST['invoice_resend']) && (int)trim($_POST['invoice_resend']) == 1) {
		
		require('Zend/Mail.php');
		
		$html = $smarty->fetch($_SERVER['DOCUMENT_ROOT'].$invoiceData['invoice_file']);
		
		$mail = new Zend_Mail();				
		$mail->setFrom('no-reply@collop.c.za', 'Collop (Resent) Invoices'); //EDIT!!											
		//$mail->addTo($invoiceData['client_contact_email']);
		$mail->addTo('invoices@collop.co.za');
		$mail->setSubject('Collop Invoices (Resent) '.$invoiceData['client_company']);
		$mail->setBodyHtml($html);		
		if($mail->send()) {
			$smarty->assign('resend', 1);
		} else {
			$smarty->assign('resend', 0);
		}
	} else {
	
		if(count($errorArray) == 0 && $formValid == true) {
			
			/* required. */		
			$data['invoice_more']	= htmlspecialchars_decode(stripslashes(trim($_POST['invoice_more'])));	
			$data['invoice_paid'] 	= isset($_POST['invoice_paid']) && (int)trim($_POST['invoice_paid']) == 1 ? 1 : 0;				
		
			/*Update. */
			$where		= $invoiceObject->getAdapter()->quoteInto('pk_invoice_id = ?', $invoiceData['pk_invoice_id']);
			$success	= $invoiceObject->update($data, $where);
					
			if(is_numeric($success) && $success > 0) {
				header('Location: /admin/products/invoices/');
				exit;		
			}
		}
	}
}

/* Display the template  */	
$smarty->display('admin/products/invoices/details.tpl');
?>