<?php
/* Add this on all pages on top. */
set_include_path($_SERVER['DOCUMENT_ROOT'].'/'.PATH_SEPARATOR.$_SERVER['DOCUMENT_ROOT'].'/library/classes/');

/*** Standard includes  */
require_once 'config/database.php';
require_once 'config/smarty.php';

require_once 'admin/includes/auth.php';

require_once 'class/invoice.php';

$invoiceObject	= new class_invoice();
 
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

/* Filter. */
$filter							= "invoice_deleted = 0";
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
$smarty->display('admin/products/invoices/default.tpl');

?>