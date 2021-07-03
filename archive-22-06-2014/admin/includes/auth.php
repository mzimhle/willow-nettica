<?php
//standard config include.
require_once 'config/database.php';
require_once 'config/smarty.php';

//include the Zend class for Authentification
require_once 'Zend/Session.php';

// Set up the namespace
$zfsession = new Zend_Session_Namespace('BackendLogin');

// Check if logged in, otherwise redirect
if (!isset($zfsession->identity) || is_null($zfsession->identity) || $zfsession->identity == '') {
	header('Location: /admin/login.php');
	exit();
} else {
	
	if(!isset($zfsession->userData)) {
		//instantiate the users class
		require_once 'class/administrator.php';
		$users = new class_administrator();
		
		//get user details by username
		$userData = $users->checkEmail($zfsession->identity);		
		
		/* Save login in a session. */
		$zfsession->userData = $userData;
	}
	
	$smarty->assign('userData', $zfsession->userData );
}

$page = explode('/',$_SERVER['REQUEST_URI']);
$currentPage = isset($page[2]) && trim($page[2]) != '' ? trim($page[2]) : '';

if($zfsession->userData == 'NE') {
	if($page[2] == 'archive' || $page[2] == 'newsletters' || $page[2] == 'enquiries') {
	
	} else {
		header('Location: /admin/logout.php');
		exit;
	}
	
}
?>