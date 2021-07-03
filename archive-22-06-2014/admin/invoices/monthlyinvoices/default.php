<?php
/* Add this on all pages on top. */
set_include_path($_SERVER['DOCUMENT_ROOT'].'/'.PATH_SEPARATOR.$_SERVER['DOCUMENT_ROOT'].'/library/classes/');

/*** Standard includes  */
require_once 'config/database.php';
require_once 'config/smarty.php';

require_once 'admin/includes/auth.php';

require_once 'class/invoicemonthly.php';

$monthlyinvoiceObject	= new class_invoicemonthly();

/* Filter. */
$filter						= "invoiceMonthly_deleted = 0";
$filter_fields				= "search_text~t"; // filter fields to remember
$filter_search_fields	= "fk_invoice_reference~t"; // should be text only fields
$select_score 			= '';
$order_score 			= '';

require_once 'admin/includes/filter.php';

global $filter;

/* Setup Pagination. */

$monthlyinvoicesData = $monthlyinvoiceObject->getAll($filter,'invoicemonthly.invoiceMonthly_added DESC');

$smarty->assign('monthlyinvoicesItems', $monthlyinvoicesData);


/* End Pagination Setup. */

/* display template */
$smarty->display('admin/invoices/monthlyinvoices/default.tpl');

?>