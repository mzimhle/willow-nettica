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

require_once 'class/domain.php';
require_once 'class/client.php';
require_once 'class/calendartype.php';
require_once 'class/calendar.php';

$clientObject				= new class_client();
$domainObject 			= new class_domain();
$calendartypeObject 	= new class_calendartype();
$calendarObject			= new class_calendar();

$clientPairs 		= $clientObject->pairs();
$domainPairs 	= $domainObject->pairs();
$calendartypePairs 	= $calendartypeObject->pairs();

if(count($calendartypePairs) > 0) $smarty->assign('calendartypePairs', $calendartypePairs);
if(count($clientPairs) > 0) $smarty->assign('clientPairs', $clientPairs);
if(count($domainPairs) > 0) $smarty->assign('domainPairs', $domainPairs);

if(isset($_GET['id']) && (int)trim($_GET['id']) != 0) {
	
	$calendarid = (int)trim($_GET['id']);
	
	$calendarData = $calendarObject->getById($calendarid);
	
	if(count($calendarData) > 0) {
		$smarty->assign('calendarData', $calendarData);
	} else {
		echo 'invalid calendar item.';
		exit;
	}
}

/*
if (!empty($_GET['date']) && $_GET['date'] != '') {

	$date = trim($_GET['date']);
	
	if($date != date('Y-n-j', strtotime($date))) {
		echo 'not a valid date';
		exit;
	}
} else {
	echo 'no date selected.';
	exit;
}

$smarty->assign('date', $date);
*/

/* Check posted data. */
if(count($_POST) > 0) {

	$errorArray		= array();
	$data 			= array();
	$formValid		= true;
	$success		= NULL;
	$areaByName	= NULL;
	
	if(isset($_POST['calendar_name']) && trim($_POST['calendar_name']) == '') {
		$errorArray['calendar_name'] = 'required';
		$formValid = false;		
	}		
	
	if(isset($_POST['fk_calendarType_id']) && (int)trim($_POST['fk_calendarType_id']) == 0) {
		$errorArray['fk_calendarType_id'] = 'required';
		$formValid = false;		
	}

	if(isset($_POST['calendar_from']) && (int)trim($_POST['calendar_from']) == 0) {
		$errorArray['calendar_from'] = 'required';
		$formValid = false;
	}
	
	if(isset($_POST['calendar_to']) && (int)trim($_POST['calendar_to']) == 0) {
		$errorArray['calendar_to'] = 'required';
		$formValid = false;
	}
	
	if(count($errorArray) == 0 && $formValid == true) {
		
		/* required. */
		$data['calendar_name'] 				= trim($_POST['calendar_name']);	
		$data['fk_calendarType_id'] 		= isset($_POST['fk_calendarType_id']) && trim($_POST['fk_calendarType_id']) != '' ? trim($_POST['fk_calendarType_id']) : '';	
		$data['fk_client_reference'] 		= isset($_POST['fk_client_reference']) && trim($_POST['fk_client_reference']) != '' ? trim($_POST['fk_client_reference']) : '';	
		$data['fk_domain_id'] 				= isset($_POST['fk_domain_id']) && trim($_POST['fk_domain_id']) != '' ? trim($_POST['fk_domain_id']) : '';	
		$data['fk_invoice_reference'] 		= isset($_POST['fk_invoice_reference']) && trim($_POST['fk_invoice_reference']) != '' ? trim($_POST['fk_invoice_reference']) : '';			
		$data['calendar_from'] 				= isset($_POST['calendar_from']) && trim($_POST['calendar_from']) != '' ? trim($_POST['calendar_from']) : '';	
		$data['calendar_to'] 					= isset($_POST['calendar_to']) && trim($_POST['calendar_to']) != '' ? trim($_POST['calendar_to']) : '';	
		$data['calendar_description'] 		= htmlspecialchars_decode(stripslashes(trim($_POST['calendar_description'])));	

		if(isset($calendarData)) {
			/*Update. */
			$where = $calendarObject->getAdapter()->quoteInto('pk_calendar_id = ?', $calendarData['pk_calendar_id']);
			$success = $calendarObject->update($data, $where);
		} else {
			/* Insert. */
			$success = $calendarObject->insert($data);
		}				
		
		if(is_numeric($success) && $success > 0) {
			$smarty->assign('success', '<span style="color: green; font-size: 1.2em; font-weight: bold;">Item has been added.</span>');
		}
	}
	
	/* if we are here there are errors. */
	$smarty->assign('errorArray', $errorArray);	
	
}

 /* Display the template  */	
$smarty->display('admin/archive/calendar/add.tpl');
?>