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

require_once 'class/subscriber.php';

$subscriberObject	= new class_subscriber();

if (!empty($_GET['code']) && $_GET['code'] != '') {

	$code = (int)$_GET['code'];

	$subscriberData = $subscriberObject->getByReference($code);
	
	if($subscriberData) {
		$smarty->assign('subscriberData', $subscriberData);
	} else {
		header('Location: /admin/newsletters/subscribers/');
		exit;
	}
}

/* Check posted data. */
if(count($_POST) > 0) {

	$errorArray		= array();
	$data 			= array();
	$formValid		= true;
	$success		= NULL;

	if(isset($_POST['statusbutton']) && (int)trim($_POST['statusbutton']) == 3 && isset($subscriberData)) {
		/* Delete account. */
		$data['subscriber_deleted']	= 1;
		$where = $subscriberObject->getAdapter()->quoteInto('subscriber_code = ?', $subscriberData['subscriber_code']);
		$success = $subscriberObject->update($data, $where);	
		
		if(is_numeric($success) && $success > 0) {
			header('Location: /admin/newsletters/subscribers/');
			exit;		
		}
	}	
	
	if(isset($_POST['subscriber_name']) && trim($_POST['subscriber_name']) == '') {
		$errorArray['subscriber_name'] = 'required';
		$formValid = false;		
	}	
	
	if(isset($_POST['subscriber_surname']) && trim($_POST['subscriber_surname']) == '') {
		$errorArray['subscriber_surname'] = 'required';
		$formValid = false;		
	}
	
	if(isset($_POST['subscriber_email']) && trim($_POST['subscriber_email']) == '') {
		$errorArray['subscriber_email'] = 'required';
		$formValid = false;		
	} else {
		if(!preg_match('/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/', trim($_POST['subscriber_email']))) {
			$errorArray['subscriber_email'] = 'Enter Valid email';
			$formValid = false;	
		} else {
		
			$checked = $subscriberObject->checkEmail(trim($_POST['subscriber_email']));
			
			if($checked) {
				$errorArray['subscriber_email'] = 'Already exists.';
				$formValid = false;				
			}
		}	
	}
	
	if(count($errorArray) == 0 && $formValid == true) {
		
		/* required. */
		$data['subscriber_name'] 		= trim($_POST['subscriber_name']);				
		$data['subscriber_surname'] 	= trim($_POST['subscriber_surname']);
		$data['subscriber_email'] 		= trim($_POST['subscriber_email']);		
		$data['subscriber_cell'] 			= trim($_POST['subscriber_cell']);	
		$data['subscriber_active']		= (int)trim($_POST['statusbutton']) == 1 ? 1 : 0;
		
		if(isset($subscriberData)) {
			/*Update. */
			$where = $subscriberObject->getAdapter()->quoteInto('subscriber_code = ?', $subscriberData['subscriber_code']);
			$success = $subscriberObject->update($data, $where);
		} else {
			/* Insert. */
			$data['subscriber_code']	= $subscriberObject->createReference();		
			$success = $subscriberObject->insert($data);
		}				
		
		if(is_numeric($success) && $success > 0) {
			header('Location: /admin/newsletters/subscribers/');
			exit;		
		}
	}
	
	/* if we are here there are errors. */
	$smarty->assign('errorArray', $errorArray);	
	
	if(!isset($subscriberData)) {
		//$smarty->assign('subscriberData', $_POST);
	} else {
		$smarty->assign('subscriberData', $subscriberData);		
	}
}

 /* Display the template  */	
$smarty->display('admin/newsletters/subscribers/details.tpl');
?>