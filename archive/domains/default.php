<?php
/* Add this on all pages on top. */
set_include_path($_SERVER['DOCUMENT_ROOT'].'/'.PATH_SEPARATOR.$_SERVER['DOCUMENT_ROOT'].'/library/classes/');

/**
 * Standard includes
 */
require_once 'config/database.php';
require_once 'config/smarty.php';
require_once 'whois.class.php';


/* Check posted data. */
if(count($_POST) > 0) {
	
	$result	= true;	
		
	if(isset($_REQUEST['domain'])) {
		
		$url			= isset($_REQUEST['domain']) && trim($_REQUEST['domain']) != '' ? trim($_REQUEST['domain']) : '';

           //check, if a valid url is provided
           if($url == '')
           {
                $message = 'URL provided wasn\'t valid';
				$result = false;
           } else {
		   
           //make the connection with curl
           $cl = curl_init($url);
           curl_setopt($cl,CURLOPT_CONNECTTIMEOUT,10);
           curl_setopt($cl,CURLOPT_HEADER,true);
           curl_setopt($cl,CURLOPT_NOBODY,true);
           curl_setopt($cl,CURLOPT_RETURNTRANSFER,true);
 
           //get response
           $response = curl_exec($cl);
 
           curl_close($cl);
 
			if ($response) {
				$message = 'The domain: '.$_REQUEST['domain'].' is not available.';
				$result = false;
			} else {
				$message = 'The domain: '.$_REQUEST['domain'].' is avialable, contact us if you would like to register it.';
			}
		  }
	} else {
		$message = 'No domain has been added.';
		$result = false;
	}
	
	$smarty->assign('error', $message);
	
}	

//display template
$smarty->display('domains/default.tpl');
?>