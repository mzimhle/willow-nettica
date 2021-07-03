<?php
/* Add this on all pages on top. */
set_include_path($_SERVER['DOCUMENT_ROOT'].'/'.PATH_SEPARATOR.$_SERVER['DOCUMENT_ROOT'].'/library/classes/');

/*** Standard includes  */
require_once 'config/database.php';
require_once 'config/smarty.php';

require_once 'admin/includes/auth.php';

require_once 'class/invoice.php';

$invoiceObject	= new class_invoice();
 

/* Filter. */
$filter						= "invoice_deleted = 0 and invoice_paid = 1";
$filter_fields				= "search_text~t"; // filter fields to remember
$filter_search_fields	= "invoice_reference~t"; // should be text only fields
$select_score 			= '';
$order_score 			= '';

require_once 'admin/includes/filter.php';

global $filter;

/* Setup Pagination. */

$invoiceData = $invoiceObject->getAll($filter,'invoice.invoice_added DESC');

$smarty->assign('invoiceItems', $invoiceData);


/* End Pagination Setup. */

/* display template */
$smarty->display('admin/invoices/paid/default.tpl');

?>