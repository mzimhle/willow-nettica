<?php

/* Add this on all pages on top. */
set_include_path($_SERVER['DOCUMENT_ROOT'].'/'.PATH_SEPARATOR.$_SERVER['DOCUMENT_ROOT'].'/library/classes/');

/** Standard includes */
require_once 'config/database.php';
require_once 'config/smarty.php';
require_once 'global_functions.php';

require_once 'class/newsletter.php';

$newsletterObject = new class_newsletter();

$date 			= isset($_GET['date']) && trim($_GET['date']) != '' ? trim($_GET['date']) : '';
$newsletter 	= isset($_GET['newsletter']) && trim($_GET['newsletter']) != '' ? trim($_GET['newsletter']) : '';

if($date != '' && $newsletter != '') {

	$link = '/newsletters/'.$date.'/'.$newsletter.'.html';
	
} else {
	header('Location: /404.php');
	exit;
}

$newsletterData = $newsletterObject->getByLink($link);

if($newsletterData) {
	$smarty->assign('newsletterData', $newsletterData);
} else {
	header('Location: /404.php');
	exit;
}

 /* Display the template */	
$smarty->display('newsletters/default.tpl');
?>