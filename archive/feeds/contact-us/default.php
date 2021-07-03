<?php
/* Add this on all pages on top. */
set_include_path($_SERVER['DOCUMENT_ROOT'].'/'.PATH_SEPARATOR.$_SERVER['DOCUMENT_ROOT'].'/library/classes/');

/**
 * Standard includes
 */
require_once 'config/database.php';
require_once 'config/smarty.php';
require_once 'global_functions.php';
require_once 'class/enquiry.php';

/* Check posted data. */
if(count($_POST) > 0) {

	$errorMessages		= array();
	$data 							= array();
	$formValid					= true;
	$success					= NULL;
	$areaByName			= NULL;
	$enquiryObject			= new class_enquiry();
	
	if(isset($_POST['enquiry_comments']) && trim($_POST['enquiry_comments']) == '') {
		$errorMessages['enquiry_comments'] = 'message required';
		$formValid = false;		
	}
		
	if(isset($_POST['enquiry_name']) && trim($_POST['enquiry_name']) == '') {
		$errorMessages['enquiry_name'] = 'fullname required';
		$formValid = false;		
	}
	
	if(isset($_POST['enquiry_number']) && trim($_POST['enquiry_number']) == '') {
		$errorMessages['enquiry_number'] = 'number required';
		$formValid = false;		
	} else {
		/* Check valid number. */
		if(!preg_match('/^[0-9]{10}$/', trim($_POST['enquiry_number']))) {
			$errorMessages['enquiry_number'] = 'Enter Valid cell/phone number. e.g. 0735654825';
		}	
	}
	
	if(isset($_POST['enquiry_email']) && trim($_POST['enquiry_email']) != '') {
		if(!preg_match('/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/', trim($_POST['enquiry_email']))) {
			$errorMessages['enquiry_email'] = 'enter valid email';
		}	
	} else {
		$errorMessages['enquiry_email'] = 'email missing.';
	}

	if(count($errorMessages) == 0 && $formValid == true) {

		$data 	= array();	
		$data['enquiry_name'] 				= trim($_POST['enquiry_name']);
		$data['enquiry_email'] 				= trim($_POST['enquiry_email']);
		$data['enquiry_number'] 			= trim($_POST['enquiry_number']);
		$data['enquiry_comments']		= trim($_POST['enquiry_comments']);
		$data['enquiry_reference']		= $enquiryObject->createReference();
		
		$success  = $enquiryObject->insert($data);

		require('Zend/Mail.php');
		
		$mail = new Zend_Mail();
		
		$smarty->assign('enquiryData', $data);	
		
		$message = $smarty->fetch('mailers/enquiry.html');
		$mail->setFrom('info@willow-nettica.co.za', 'Willow Nettica Enquiry'); //EDIT!!											
		$mail->addTo($data['enquiry_email']);
		$mail->addTo('info@willow-nettica.co.za');
		$mail->setSubject('Willow Nettica Enquiry');
		$mail->setBodyHtml($message);			

		$mail->send();

		$smarty->assign('success', 1);	

	}

	/* if we are here there are errors. */
	$smarty->assign('errorMessages', $errorMessages);	
	$smarty->assign('enquiryData', $_POST);	
	
}	

//display template
$smarty->display('feeds/contact-us/default.tpl');
?>