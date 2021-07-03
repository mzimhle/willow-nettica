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

$invoiceObject		= new class_invoice();
$invoiceitemObject	= new class_invoiceitem();
$invoicefileObject	= new class_invoicefile();

if (!empty($_GET['reference']) && $_GET['reference'] != '') {

	$reference = trim($_GET['reference']);

	$invoiceData = $invoiceObject->getByReference($reference);
	
	if(count($invoiceData) > 0) {
		$smarty->assign('invoiceData', $invoiceData);
	} else {
		header('Location: /admin/invoices/paid/');
		exit;
	}
} else {
	header('Location: /admin/invoices/paid/');
	exit;
}

$invoiceitemData = $invoiceitemObject->getByInvoiceReference($reference);

if(count($invoiceitemData) > 0)  $smarty->assign('invoiceitemData', $invoiceitemData);


$invoicefileData = $invoicefileObject->getByInvoiceReference($reference);

if(count($invoicefileData) > 0)  $smarty->assign('invoicefileData', $invoicefileData);

/* Display the template  */	
$smarty->display('admin/invoices/paid/details.tpl');
?>