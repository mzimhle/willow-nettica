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
require_once 'class/invoice.php';
require_once 'pdfcrowd/pdfcrowd.php';

$invoiceObject	= new class_invoice();

$reference		= isset($_REQUEST['reference']) && trim($_REQUEST['reference']) != '' ? trim($_REQUEST['reference']) : '';

$invoiceData = $invoiceObject->getByReference($reference);

if(count($invoiceData) > 0) {
		
		$htmlfile 	= $_SERVER['DOCUMENT_ROOT'].$invoiceData['invoice_file'];
		$pdffile		= 	$_SERVER['DOCUMENT_ROOT'].'/media/invoices/'.$invoiceData['fk_client_reference'].'/'.$invoiceData['invoice_reference'].'.pdf';
		
		header("Content-Type: application/pdf");
		header("Cache-Control: no-cache");
		header("Accept-Ranges: none");
		header("Content-Disposition: attachment; filename=\"".$invoiceData['invoice_reference'].".pdf\"");			
		
		echo file_get_contents($pdffile);
		exit;		

} else {
	echo 'Invalid reference';
	exit;
}


?>