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

require_once 'class/spam.php';
require_once 'class/spamtype.php';

$spamObject			= new class_spam();
$spamtypeObject	= new class_spamtype();

$spamtypePairs 	= $spamtypeObject->pairs();

if(count($spamtypePairs) > 0) $smarty->assign('spamtypePairs', $spamtypePairs);

if (!empty($_GET['spamid']) && $_GET['spamid'] != '') {

	$spamid = (int)$_GET['spamid'];

	$spamData = $spamObject->getById($spamid);
	
	if($spamData) {
	
		$smarty->assign('spamData', $spamData);
	} else {
		header('Location: /admin/archive/scrape/');
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

	if(isset($_POST['statusbutton']) && (int)trim($_POST['statusbutton']) == 3 && isset($spamData)) {
		/* Delete account. */
		$data['spam_deleted']	= 1;
		$where = $spamObject->getAdapter()->quoteInto('pk_spam_id = ?', $spamData['pk_spam_id']);
		$success = $spamObject->update($data, $where);	
		
		if(is_numeric($success) && $success > 0) {
			header('Location: /admin/spams/companies/');
			exit;		
		}
	}	
	
	if(isset($_POST['spam_name']) && trim($_POST['spam_name']) == '') {
		$errorArray['spam_name'] = 'required';
		$formValid = false;		
	}		
	
	if(count($errorArray) == 0 && $formValid == true) {
		
		/* required. */
		$data['spam_name'] 			= isset($_POST['spam_name']) && trim($_POST['spam_name']) != '' ? trim($_POST['spam_name']) : '';				
		$data['spam_email'] 			= isset($_POST['spam_email']) && trim($_POST['spam_email']) != '' ? trim($_POST['spam_email']) : '';				
		$data['spam_number'] 		= isset($_POST['spam_number']) && trim($_POST['spam_number']) != '' ? trim($_POST['spam_number']) : '';				
		$data['spam_fax'] 				= isset($_POST['spam_fax']) && trim($_POST['spam_fax']) != '' ? trim($_POST['spam_fax']) : '';				
		$data['spam_link'] 			= isset($_POST['spam_link']) && trim($_POST['spam_link']) != '' ? trim($_POST['spam_link']) : '';				
		$data['spam_referer'] 		= isset($_POST['spam_referer']) && trim($_POST['spam_referer']) != '' ? trim($_POST['spam_referer']) : '';				
		$data['fk_spamType_id']	= isset($_POST['fk_spamType_id']) && trim($_POST['fk_spamType_id']) != '' ? trim($_POST['fk_spamType_id']) : '';	
		$data['spam_text'] 			= htmlspecialchars_decode(stripslashes(trim($_POST['spam_text'])));			
		$data['spam_active']			= (int)trim($_POST['statusbutton']) == 1 ? 1 : 0;					
				
		if(isset($spamData)) {
			/*Update. */
			$where = $spamObject->getAdapter()->quoteInto('pk_spam_id = ?', $spamData['pk_spam_id']);
			$success = $spamObject->update($data, $where);
		} else {
			/* Insert. */	
			$success = $spamObject->insert($data);
		}				
		
		if(is_numeric($success) && $success > 0) {
			header('Location: /admin/archive/scrape/');
			exit;		
		}
	}
	
	/* if we are here there are errors. */
	$smarty->assign('errorArray', $errorArray);	
	
	if(!isset($spamData)) {
		//$smarty->assign('spamData', $_POST);
	} else {
		$smarty->assign('spamData', $spamData);		
	}
}

 /* Display the template  */	
$smarty->display('admin/archive/scrape/details.tpl');
?>