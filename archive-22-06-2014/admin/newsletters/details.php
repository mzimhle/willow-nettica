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

require_once 'class/newsletter.php';

$newsletterObject	= new class_newsletter();

if (!empty($_GET['reference']) && $_GET['reference'] != '') {

	$reference = (int)$_GET['reference'];

	$newsletterData = $newsletterObject->getByReference($reference);
	
	if(count($newsletterData) > 0) {
		$smarty->assign('newsletterData', $newsletterData);
	}
}

/* Check posted data. */
if(count($_POST) > 0) {
	
	$errorArray		= array();
	$data 			= array();
	$formValid		= true;
	$success		= NULL;
	$areaByName	= NULL;
	
	if(isset($_POST['statusbutton']) && (int)trim($_POST['statusbutton']) == 3 && isset($newsletterData)) {
		/* Delete newsletter. */
		$data['newsletter_deleted']	= 1;
		$where = $newsletterObject->getAdapter()->quoteInto('pk_newsletter_id = ?', $newsletterData['pk_newsletter_id']);
		$success = $newsletterObject->update($data, $where);		
		
		if(is_numeric($success) && $success > 0) {
			header('Location: /admin/newsletters/');
			exit;		
		}
	}	
	
	if(isset($_POST['newsletter_title']) && trim($_POST['newsletter_title']) == '') {
		$errorArray['newsletter_title'] = 'required';
		$formValid = false;		
	}		
	
	
	if(isset($_POST['newsletter_page']) && trim($_POST['newsletter_page']) == '') {
		$errorArray['newsletter_page'] = 'required';
		$formValid = false;		
	}		
	
	if(count($errorArray) == 0 && $formValid == true) {
		
		/* required. */
		$data['newsletter_title'] 			= trim($_POST['newsletter_title']);			
		$data['newsletter_content'] 	= trim($_POST['newsletter_content']);	
		$data['newsletter_active']		= (int)trim($_POST['statusbutton']) == 1 ? 1 : 0;		
		
		$date									= isset($newsletterData) ? $newsletterData['newsletter_added'] : date('Y-m-d');
		
		$smarty->assign('date', $date);
		$smarty->assign('data', $data);
		
		$html = $smarty->fetch('templates/newsletter/newsletter.html');
		
		$data['newsletter_page']	= $html;
		$data['newsletter_content']	= htmlspecialchars_decode(stripslashes(trim($_POST['newsletter_content'])));
		
		/* Save file. */
		$directory	= $_SERVER['DOCUMENT_ROOT'].'/newsletters/'.date('Y-m-d').'/';
		$linkname	= $newsletterObject->toLink(strtolower(trim($_POST['newsletter_title']))).'.html';
		$filename	= $directory.$linkname;
		
		if(!is_dir($directory)) mkdir($directory, 0777, true);	
		
		$data['newsletter_link']	= '/newsletters/'.date('Y-m-d').'/'.$linkname;
		
		if(file_put_contents($filename, $html)) {
		
			if(isset($newsletterData)) {
				/*Update. */
				$where = $newsletterObject->getAdapter()->quoteInto('pk_newsletter_id = ?', $newsletterData['pk_newsletter_id']);
				$success = $newsletterObject->update($data, $where);
			} else {
				/* Insert. */
				$data['newsletter_reference'] = $newsletterObject->createReference();
				$success = $newsletterObject->insert($data);
			}				
		}
		
		if(is_numeric($success) && $success > 0) {
			header('Location: /admin/newsletters/');
			exit;		
		}
	}
	
	/* if we are here there are errors. */
	$smarty->assign('errorArray', $errorArray);	
	
}

 /* Display the template  */	
$smarty->display('admin/newsletters/details.tpl');
?>