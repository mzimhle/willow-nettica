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
require_once 'class/clientproduct.php';
require_once 'class/product.php';
require_once 'class/client.php';

$clientProductObject	= new class_clientproduct();
$productObject			= new class_product();
$clientObject				= new class_client();

if (!empty($_GET['reference']) && $_GET['reference'] != '') {
	
	$reference = trim($_GET['reference']);
	
	$clientData = $clientObject->getByReference($reference);
	
	if(count($clientData) > 0) {
		$smarty->assign('clientData', $clientData);
	} else {
		header('Location: /admin/products/clientproducts/');
		exit;
	}
} else {
	header('Location: /admin/products/clientproducts/');
	exit;
} 

/* Get pairs. */
$productPairs = $productObject->pairs();
if(count($productPairs) > 0) $smarty->assign('productPairs', $productPairs);
/* Get client products. */
$clientProductData = $clientProductObject->getByClientReference($reference);

if(count($clientProductData) > 0) {
	$smarty->assign('clientProductData', $clientProductData);
}

	
/* Check posted data. */
if(count($_POST) > 0) {

	$errorArray		= array();
	$data 			= array();
	$formValid		= true;
	$success		= NULL;
	
	if(isset($_POST['fk_product_reference']) && trim($_POST['fk_product_reference']) == '') {
		$errorArray['fk_product_reference'] = 'Product Required';
		$formValid = false;		
	}	
	/*
	if(isset($_POST['clientproduct_payment_date']) && trim($_POST['clientproduct_payment_date']) == '') {
		$errorArray['clientproduct_payment_date'] = 'Date Required';
		$formValid = false;		
	} else {
			$date	= trim($_POST['clientproduct_payment_date']) ;
			$array	= explode('-', $date);
			if (checkdate($array[0], $array[1], $array[2])) {
				// valid date ...
			} else {
				$errorArray['clientproduct_payment_date'] = 'Valide Date Required';
				$formValid = false;					
			}
	}
	*/
	
	if(count($errorArray) == 0 && $formValid == true) {
		
		$data 	= array();		
		$data['fk_product_reference'] 	= trim($_POST['fk_product_reference']);		
		$data['fk_client_reference']		= $clientData['client_reference'];
		$data['clientproduct_active'] 		= isset($_POST['clientproduct_active']) && (int)trim($_POST['clientproduct_active']) == 1 ? 1 : 0;
		
		/* Insert */
		$success = $clientProductObject->insert($data);	
		
		
		if(is_numeric($success) && $success > 0) {		
			
			header('Location: /admin/products/clientproducts/details.php?reference='.$reference);
			exit();				
		}
	}	
	
	/* if we are here there are errors. */
	$smarty->assign('errorArray', $errorArray);	
}

 /* Display the template
 */	
$smarty->display('admin/products/clientproducts/details.tpl');

$errorArray = $data = $success = $formValid = $areaMapObject = $recruiterAgentObject = $areaMapObject = $areaByName = NULL;
UNSET($errorArray, $data, $success, $formValid, $areaMapObject, $recruiterAgentObject, $areaMapObject, $areaByName);
?>