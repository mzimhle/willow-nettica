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
require_once 'class/client.php';

$clientObject	= new class_client();
$areaMapObject 			= new class_areaMap();

if (!empty($_GET['clientid']) && $_GET['clientid'] != '') {

	$clientid = (int)$_GET['clientid'];

	$clientData = $clientObject->getByclientId($clientid);
	
	if(count($clientData) > 0) {
		$smarty->assign('clientData', $clientData);
	} else {
		header('Location: /admin/clients/companies/');
		exit;
	}
}

/* Check posted data. */
if(count($_POST) > 0) {

	$errorArray		= array();
	$data 			= array();
	$formValid		= true;
	$success		= NULL;
	$areaByName	= NULL;
	$paymentdate	= NULL;

	if(isset($_POST['statusbutton']) && (int)trim($_POST['statusbutton']) == 3 && isset($clientData)) {
		/* Delete account. */
		$data['client_deleted']	= 1;
		$where = $clientObject->getAdapter()->quoteInto('pk_client_id = ?', $clientData['pk_client_id']);
		$success = $clientObject->update($data, $where);	
		
		if(is_numeric($success) && $success > 0) {
			header('Location: /admin/clients/companies/');
			exit;		
		}
	}	
	
	if(isset($_POST['client_company']) && trim($_POST['client_company']) == '') {
		$errorArray['client_company'] = 'required';
		$formValid = false;		
	}	
	
	if(isset($_POST['client_contact_name']) && trim($_POST['client_contact_name']) == '') {
		$errorArray['client_contact_name'] = 'required';
		$formValid = false;		
	}
	
	if(isset($_POST['client_contact_email']) && trim($_POST['client_contact_email']) == '') {
		$errorArray['client_contact_email'] = 'required';
		$formValid = false;		
	} else {
		if(!preg_match('/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/', trim($_POST['client_contact_email']))) {
			$errorArray['client_contact_email'] = 'Enter Valid email';
			$formValid = false;	
		} 	
	}		
	
	if(isset($_POST['client_contact_surname']) && trim($_POST['client_contact_surname']) == '') {
		$errorArray['client_contact_surname'] = 'required';
		$formValid = false;		
	}	
	
	if(isset($_POST['areaName']) && trim($_POST['areaName']) == '') {
		$errorArray['areaName'] = 'required';
		$formValid = false;		
	} else {
		/* Check if it exists. */
		$areaByName = $areaMapObject->getByFullPath(trim($_POST['areaname']));
		if(count($areaByName) == 0) {
			$errorArray['areaName'] = 'required';
			$formValid = false;				
		}
	}
	
	if(isset($_POST['client_paying']) && (int)trim($_POST['client_paying']) == 1 ) {
		if(isset($_POST['client_payment_date']) && trim($_POST['client_payment_date']) == '') {
			$errorArray['client_payment_date'] = 'Date Required';
			$formValid = false;		
		} else {
			if (date('Y-m-d', strtotime($_POST['client_payment_date'])) == trim($_POST['client_payment_date'])) {
				$paymentdate = trim($_POST['client_payment_date']);
			} else {
				$errorArray['client_payment_date'] = 'Valide Date Required';
				$formValid = false;					
			}
		}
	} 
	
	if(count($errorArray) == 0 && $formValid == true) {
		
		/* required. */
		$data['client_company'] 				= trim($_POST['client_company']);				
		$data['client_contact_name'] 		= trim($_POST['client_contact_name']);
		$data['client_contact_surname'] 	= trim($_POST['client_contact_surname']);		
		$data['client_contact_cell'] 			= trim($_POST['client_contact_cell']);	
		$data['client_contact_position'] 	= trim($_POST['client_contact_position']);	
		$data['client_contact_telephone'] = trim($_POST['client_contact_telephone']);	
		$data['client_contact_email'] 		= trim($_POST['client_contact_email']);	
		$data['client_address'] 				= trim($_POST['client_address']);
		$data['client_payment_date'] 		= $paymentdate;
		$data['client_active']					= (int)trim($_POST['statusbutton']) == 1 ? 1 : 0;		
		$data['client_paying'] 				= isset($_POST['client_paying']) && (int)trim($_POST['client_paying']) == 1 ? 1 : 0;
		$data['client_mdc']	 					= isset($_POST['client_mdc']) && (int)trim($_POST['client_mdc']) == 1 ? 1 : 0;
		$data['fk_area_id']						= $areaByName[0]['fkAreaId'];					
		
		if(isset($clientData)) {
			/*Update. */
			$where = $clientObject->getAdapter()->quoteInto('pk_client_id = ?', $clientData['pk_client_id']);
			$success = $clientObject->update($data, $where);
		} else {
			/* Insert. */
			$data['client_reference']	= $clientObject->createReference();		
			$success = $clientObject->insert($data);
		}				
		
		if(is_numeric($success) && $success > 0) {
			header('Location: /admin/clients/companies/');
			exit;		
		}
	}
	
	/* if we are here there are errors. */
	$smarty->assign('errorArray', $errorArray);	
	
	if(!isset($clientData)) {
		//$smarty->assign('clientData', $_POST);
	} else {
		$smarty->assign('clientData', $clientData);		
	}
}

 /* Display the template  */	
$smarty->display('admin/clients/companies/details.tpl');
?>