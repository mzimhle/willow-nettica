<?php
/* Add this on all pages on top. */
set_include_path($_SERVER['DOCUMENT_ROOT'].'/'.PATH_SEPARATOR.$_SERVER['DOCUMENT_ROOT'].'/library/classes/');

/*** Standard includes  */
require_once 'config/database.php';
require_once 'config/smarty.php';

require_once 'admin/includes/auth.php';

require_once 'class/client.php';

$clientObject	= new class_client();

/* Check posted data. */
if(isset($_REQUEST['clientproductid'])) {
	
	require_once 'class/clientproduct.php';

	$clientProductObject	= new class_clientproduct();
	
	$errorArray				= array();
	$errorArray['message']	= '';
	$error					= array();
	$errorArray['result']	= 0;
	$data 					= array();
	$formValid				= true;
	$success				= NULL;
	$clientproductid		= trim($_GET['clientproductid']);
	
	if(isset($_GET['fk_product_reference']) && trim($_GET['fk_product_reference']) == '') {
		$error[] = 'Product Required';
		$formValid = false;		
	}	
	
	if(isset($_GET['fk_client_reference']) && trim($_GET['fk_client_reference']) == '') {
		$error[] = 'Client Required';
		$formValid = false;		
	}	
	
	if($formValid && count($error)  == 0 ) {
		
		$data 	= array();		
		$data['fk_product_reference'] 	= trim($_GET['fk_product_reference']);		
		$data['fk_client_reference']		= trim($_GET['fk_client_reference']);
		$data['clientproduct_active'] 		= isset($_GET['clientproduct_active']) && (int)trim($_GET['clientproduct_active']) == 1 ? 1 : 0;
		
		$where		= array();
		$where[]	= $clientProductObject->getAdapter()->quoteInto('pk_clientproduct_id = ?', $clientproductid);
		$success	= $clientProductObject->update($data, $where);	
	}
	
	if(isset($success) && is_numeric($success) && $success > 0) {		
		$errorArray['message']	= '';
		$errorArray['result']	= 1;			
	} else {
		$errorArray['message']	= 'Could not update, please try again: '.implode(", ", $error);
		$errorArray['result']	= 0;				
	}	
	
	echo json_encode($errorArray);
	exit;
}

/* Filter. */
$filter					= "client_deleted = 0";
$filter_fields			= "search_text~t"; // filter fields to remember
$filter_search_fields 	= "client_company~t"; // should be text only fields
$select_score 			= '';
$order_score 			= '';

require_once 'admin/includes/filter.php';

global $filter;

/* Setup Pagination. */
$clientData = $clientObject->getAll($filter,'client.client_added DESC');

$smarty->assign('clientData', $clientData);

/* display template */
$smarty->display('admin/products/clientproducts/default.tpl');

?>