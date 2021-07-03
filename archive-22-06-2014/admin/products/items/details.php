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

require_once 'class/areaMap.php';
require_once 'class/product.php';

$productObject	= new class_product();
$areaMapObject 			= new class_areaMap();

if (!empty($_GET['reference']) && $_GET['reference'] != '') {

	$reference = trim($_GET['reference']);

	$productData = $productObject->getByReference($reference);
	
	if(count($productData) > 0) {
		$smarty->assign('productData', $productData);
	}
}

/* Check posted data. */
if(count($_POST) > 0) {

	$errorArray		= array();
	$data 			= array();
	$formValid		= true;
	$success		= NULL;
	$areaByName		= NULL;

	if(isset($_POST['statusbutton']) && (int)trim($_POST['statusbutton']) == 3 && isset($productData)) {
		/* Delete account. */
		$data['product_deleted']	= 1;
		$where = $productObject->getAdapter()->quoteInto('pk_product_id = ?', $productData['pk_product_id']);
		$success = $productObject->update($data, $where);	
		
		if(is_numeric($success) && $success > 0) {
			header('Location: /admin/products/items/');
			exit;		
		}
	}	
	
	if(isset($_POST['product_name']) && trim($_POST['product_name']) == '') {
		$errorArray['product_name'] = 'required';
		$formValid = false;		
	}	
	
	if(isset($_POST['product_price']) && (int)trim($_POST['product_price']) == 0) {
		$errorArray['product_price'] = 'required';
		$formValid = false;		
	}	
	
	if(isset($_POST['product_payment_type']) && trim($_POST['product_payment_type']) == '') {
		$errorArray['product_payment_type'] = 'required';
		$formValid = false;		
	}	
	
	if(count($errorArray) == 0 && $formValid == true) {
		
		/* required. */
		$data['product_name'] 				= trim($_POST['product_name']);					
		$data['product_description'] 		= htmlspecialchars_decode(stripslashes(trim($_POST['product_description'])));	
		$data['product_price'] 				= (int)trim($_POST['product_price']);		
		$data['product_active']				= (int)trim($_POST['statusbutton']) == 1 ? 1 : 0;		
		$data['product_payment_type'] 	= trim($_POST['product_payment_type']);				
		
		if(isset($productData) && count($productData) > 0) {
			/*Update. */
			$where = $productObject->getAdapter()->quoteInto('pk_product_id = ?', $productData['pk_product_id']);
			$success = $productObject->update($data, $where);
		} else {
			$data['product_reference']	= $productObject->createReference();	
			/* Insert. */
			$success = $productObject->insert($data);
		}				
		
		if(is_numeric($success) && $success > 0) {
			header('Location: /admin/products/items/');
			exit;		
		}
	}
	
	/* if we are here there are errors. */
	$smarty->assign('errorArray', $errorArray);	
	
	if(!isset($productData)) {
		// $smarty->assign('productData', $_POST);
	} else {
		$smarty->assign('productData', $productData);		
	}
}

 /* Display the template  */	
$smarty->display('admin/products/items/details.tpl');
?>