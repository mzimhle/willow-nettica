<?php

echo 'Thats it.';
exit;
/* Add this on all pages on top. */
set_include_path($_SERVER['DOCUMENT_ROOT'].'/'.PATH_SEPARATOR.$_SERVER['DOCUMENT_ROOT'].'/library/classes/');

/** Standard includes */
require_once 'config/database.php';
require_once 'config/smarty.php';
require_once 'global_functions.php';

/* Check posted data. */
if(count($_GET) > 0 && isset($_GET['ajax']) && trim($_GET['ajax']) == 1) {
	
	require_once 'class/enquiry.php';
	
	$errorMessages			= array();
	$data 						= array();
	$formValid				= true;
	$success					= NULL;
	$areaByName			= NULL;
	$enquiryObject			= new class_enquiry();
	$output						= array();
	
	if(isset($_GET['enquiry_comments']) && trim($_GET['enquiry_comments']) == '') {
		$errorMessages['enquiry_comments'] = 0;
		$formValid = false;		
	} else {
		$errorMessages['enquiry_comments'] = 1;
	}
		
	if(isset($_GET['enquiry_name']) && trim($_GET['enquiry_name']) == '') {
		$errorMessages['enquiry_name'] = 0;
		$formValid = false;		
	} else {
		$errorMessages['enquiry_name'] = 1;
	}
	
	if(isset($_GET['enquiry_number']) && trim($_GET['enquiry_number']) == '') {
		$errorMessages['enquiry_number'] = 0;
		$formValid = false;		
	} else {
		/* Check valid number. */
		if(!preg_match('/^[0-9]{10}$/', trim($_GET['enquiry_number']))) {
			$errorMessages['enquiry_number'] = 0;
			$formValid = false;
		} else {
			$errorMessages['enquiry_number'] = 1;
		}	
	}
	
	if(isset($_GET['enquiry_email']) && trim($_GET['enquiry_email']) != '') {
		if(!preg_match('/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/', trim($_GET['enquiry_email']))) {
			$errorMessages['enquiry_email'] = 0;
			$formValid = false;
		} else {
			$errorMessages['enquiry_email'] = 1;
		}	
	} else {
		$errorMessages['enquiry_email'] = 0;
		$formValid = false;
	}

	if($formValid == true) {

		$data 	= array();	
		$data['enquiry_name'] 				= trim($_GET['enquiry_name']);
		$data['enquiry_email'] 				= trim($_GET['enquiry_email']);
		$data['enquiry_number'] 			= trim($_GET['enquiry_number']);
		$data['enquiry_comments']			= trim($_GET['enquiry_comments']);
		$data['enquiry_reference']			= $enquiryObject->createReference();
		
		$success  = $enquiryObject->insert($data);

		require('Zend/Mail.php');
		
		$mail = new Zend_Mail();
		
		$smarty->assign('enquiryData', $data);	
		
		$message = $smarty->fetch('templates/inquiry/enquiry.html');
		$mail->setFrom('info@willow-nettica.co.za', 'Willow Nettica Enquiry'); //EDIT!!											
		$mail->addTo($data['enquiry_email']);
		$mail->addTo('info@willow-nettica.co.za');
		$mail->setSubject('Willow Nettica Enquiry');
		$mail->setBodyHtml($message);			

		if(!$mail->send()) {
			$formValid = false;
		}

	}

	/* if we are here there are errors. */
	$output['error'] = $errorMessages;	
	$output['result'] = $formValid;
	
	echo json_encode($output);
	exit;
}	
 /* Display the template
 */	
$smarty->display('archive-22-06-2014/default.tpl');
?>