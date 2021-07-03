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

require_once 'class/service.php';

$serviceObject	= new class_service();

if (!empty($_GET['reference']) && $_GET['reference'] != '') {

	$reference = $_GET['reference'];

	$serviceData = $serviceObject->getByReference($reference);
	
	if(count($serviceData) > 0) {
		$smarty->assign('serviceData', $serviceData);
	}
}

/* Check posted data. */
if(count($_POST) > 0) {

	$errorArray		= array();
	$data 			= array();
	$formValid		= true;
	$success		= NULL;
	$areaByName	= NULL;
	
	if(isset($_POST['service_name']) && trim($_POST['service_name']) == '') {
		$errorArray['service_name'] = 'required';
		$formValid = false;		
	}		
	
	if(isset($_POST['service_username']) && trim($_POST['service_username']) == '') {
		$errorArray['service_username'] = 'required';
		$formValid = false;		
	}	
	
	if(isset($_POST['service_password']) && trim($_POST['service_password']) == '') {
		$errorArray['service_password'] = 'required';
		$formValid = false;		
	}		
	
	if(count($errorArray) == 0 && $formValid == true) {
		
		/* required. */
		$data['service_name'] 				= trim($_POST['service_name']);	
		$data['service_username'] 			= trim($_POST['service_username']);	
		$data['service_password'] 			= trim($_POST['service_password']);	
		$data['service_link'] 					= trim($_POST['service_link']);				
		$data['service_paymentDate'] 	= trim($_POST['service_paymentDate']);		
		$data['service_itemsRemaining']	= trim($_POST['service_itemsRemaining']);				
		$data['service_description'] 		= htmlspecialchars_decode(stripslashes(trim($_POST['service_description'])));	

		if(isset($serviceData)) {
			/*Update. */
			$where = $serviceObject->getAdapter()->quoteInto('pk_service_id = ?', $serviceData['pk_service_id']);
			$success = $serviceObject->update($data, $where);
		} else {
			/* Insert. */
			$data['service_reference']	= $serviceObject->createReference();
			$success = $serviceObject->insert($data);
		}				
		
		if(is_numeric($success) && $success > 0) {
			header('Location: /admin/archive/services/');
			exit;		
		}
	}
	
	/* if we are here there are errors. */
	$smarty->assign('errorArray', $errorArray);	
	
	if(!isset($serviceData)) {
		 $smarty->assign('serviceData', $_POST);
	} else {
		$smarty->assign('serviceData', $serviceData);		
	}
}

 /* Display the template  */	
$smarty->display('admin/archive/services/details.tpl');
?>