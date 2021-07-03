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

require_once 'class/account.php';
require_once 'class/client.php';

$accountObject	= new class_account();
$clientObject		= new class_client();

$accountPairs 	= $accountObject->pairs();
$clientPairs 		= $clientObject->pairs();

if(count($accountPairs) > 0) $smarty->assign('accountPairs', $accountPairs);

if(count($clientPairs) > 0) 	$smarty->assign('clientPairs', $clientPairs);


if (!empty($_GET['reference']) && $_GET['reference'] != '') {

	$reference = (int)$_GET['reference'];

	$accountData = $accountObject->getByaccountId($reference);
	
	if(count($accountData) > 0) {
		$smarty->assign('accountData', $accountData);
	}
}

/* Check posted data. */
if(count($_POST) > 0) {
	
	$errorArray		= array();
	$data 			= array();
	$formValid		= true;
	$success		= NULL;
	$areaByName	= NULL;
	
	if(isset($_POST['statusbutton']) && (int)trim($_POST['statusbutton']) == 3 && isset($accountData)) {
		/* Delete account. */
		$data['account_deleted']	= 1;
		$where = $accountObject->getAdapter()->quoteInto('pk_account_id = ?', $accountData['pk_account_id']);
		$success = $accountObject->update($data, $where);		
		
		if(is_numeric($success) && $success > 0) {
			header('Location: /admin/accounts/logins/');
			exit;		
		}
		
	}	
	
	if(isset($_POST['account_name']) && trim($_POST['account_name']) == '') {
		$errorArray['account_name'] = 'required';
		$formValid = false;		
	}		
	
	if(isset($_POST['account_username']) && trim($_POST['account_username']) == '') {
		$errorArray['account_username'] = 'required';
		$formValid = false;		
	}	
	
	if(isset($_POST['account_password']) && trim($_POST['account_password']) == '') {
		$errorArray['account_password'] = 'required';
		$formValid = false;		
	}		
	
	if(isset($_POST['fk_client_reference']) && trim($_POST['fk_client_reference']) == '') {
		$errorArray['fk_client_reference'] = 'required';
		$formValid = false;		
	}	
	
	if(count($errorArray) == 0 && $formValid == true) {
		
		/* required. */
		$data['account_name'] 			= trim($_POST['account_name']);	
		$data['fk_client_reference'] 	= trim($_POST['fk_client_reference']);	
		$data['account_link'] 				= trim($_POST['account_link']);				
		$data['account_username'] 	= trim($_POST['account_username']);
		$data['account_password'] 		= trim($_POST['account_password']);		
		$data['fk_recovery_account']	= trim($_POST['fk_recovery_account']);	
		$data['account_active']			= (int)trim($_POST['statusbutton']) == 1 ? 1 : 0;
		$data['account_description'] 	= htmlspecialchars_decode(stripslashes(trim($_POST['account_description'])));	

		if(isset($accountData)) {
			/*Update. */
			$where = $accountObject->getAdapter()->quoteInto('pk_account_id = ?', $accountData['pk_account_id']);
			$success = $accountObject->update($data, $where);
		} else {
			/* Insert. */
			$success = $accountObject->insert($data);
		}				
		
		if(is_numeric($success) && $success > 0) {
			header('Location: /admin/accounts/logins/');
			exit;		
		}
	}
	
	/* if we are here there are errors. */
	$smarty->assign('errorArray', $errorArray);	
	
	if(!isset($accountData)) {
		 $smarty->assign('accountData', $_POST);
	} else {
		$smarty->assign('accountData', $accountData);		
	}
}

 /* Display the template  */	
$smarty->display('admin/accounts/logins/details.tpl');
?>