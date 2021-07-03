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
require_once 'class/enquiry.php';

$enquiryObject	= new class_enquiry();
$areaMapObject 			= new class_areaMap();

if (!empty($_GET['enquiryid']) && $_GET['enquiryid'] != '') {

	$enquiryid = (int)$_GET['enquiryid'];

	$enquiryData = $enquiryObject->getByReference($enquiryid);
	
	if(count($enquiryData) > 0) {
		$smarty->assign('enquiryData', $enquiryData);
	} else {
		header('Location: /admin/enquirys/companies/');
		exit;
	}
} else {
	header('Location: /admin/enquirys/companies/');
	exit;
}


 /* Display the template  */	
$smarty->display('admin/enquiries/details.tpl');
?>