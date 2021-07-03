<?php
/* Add this on all pages on top. */
set_include_path($_SERVER['DOCUMENT_ROOT'].'/'.PATH_SEPARATOR.$_SERVER['DOCUMENT_ROOT'].'/library/classes/');

/**
 * Standard includes
 */
require_once 'config/database.php';
require_once 'config/smarty.php';

/**
 * Check for login
 */
require_once 'admin/includes/auth.php';

/* objects. */
require_once 'class/domain.php';
require_once 'class/client.php';
require_once 'class/account.php';

$clientObject		= new class_client();
$domainObject 	= new class_domain();
$accountObject	= new class_account();

$clientPairs 	= $clientObject->pairs();
$accountPairs	= $accountObject->pairs();

if(count($clientPairs) > 0) $smarty->assign('clientPairs', $clientPairs);
if(count($accountPairs) > 0) $smarty->assign('accountPairs', $accountPairs);
 
/**
  * If the item exists populate the form with data
  */
if (!empty($_GET['reference']) && $_GET['reference'] != '') {
	
	$domainRef = (int)$_GET['reference'];
	
	$domainData = $domainObject->getByDomainId($domainRef);

	if(count($domainData) > 0) {
		$smarty->assign('domainData', $domainData);
	} else {		
		header('Location: /admin/domains/websites/');		
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

	if(isset($_POST['statusbutton']) && (int)trim($_POST['statusbutton']) == 3 && isset($domainData)) {
		/* Delete account. */
		$data['domain_deleted']	= 1;
		$where = $domainObject->getAdapter()->quoteInto('pk_domain_id = ?', $domainData['pk_domain_id']);
		$success = $domainObject->update($data, $where);	
		
		if(is_numeric($success) && $success > 0) {
			header('Location: /admin/domains/websites/');		
			exit;		
		}
	}	
	
	if(isset($_POST['domain_link']) && trim($_POST['domain_link']) == '') {
		$errorArray['domain_link'] = 'required';
		$formValid = false;		
	}
		
	if(isset($_POST['domain_name']) && trim($_POST['domain_name']) == '') {
		$errorArray['domain_name'] = 'required';
		$formValid = false;		
	}	
	
	if(isset($_POST['fk_client_reference']) && trim($_POST['fk_client_reference']) == '') {
		$errorArray['fk_client_reference'] = 'required';
		$formValid = false;		
	}		

	if(count($errorArray) == 0 && $formValid == true) {
		
		$data 	= array();	
		$data['domain_link'] 				= trim($_POST['domain_link']);
		$data['domain_name'] 			= trim($_POST['domain_name']);
		$data['fk_account_id'] 			= trim($_POST['fk_account_id']);
		$data['fk_client_reference'] 	= trim($_POST['fk_client_reference']);
		$data['domain_active']			= (int)trim($_POST['statusbutton']) == 1 ? 1 : 0;	
		
		if(isset($domainData) && count($domainData) > 0) {
			/*Update. */
			$where = $domainObject->getAdapter()->quoteInto('pk_domain_id = ?', $domainData['pk_domain_id']);
			$success = $domainObject->update($data, $where);
		} else {
			$success = $domainObject->insert($data);			
		}				
		
		if(is_numeric($success)) {							
			header('Location: /admin/domains/websites');				
			exit;		
		}
	}

	/* if we are here there are errors. */
	$smarty->assign('errorArray', $errorArray);	
}

$smarty->display('admin/domains/websites/details.tpl');

?>