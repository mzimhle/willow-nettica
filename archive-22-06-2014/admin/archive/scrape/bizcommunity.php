<?php

/* Add this on all pages on top. */
set_include_path($_SERVER['DOCUMENT_ROOT'].'/'.PATH_SEPARATOR.$_SERVER['DOCUMENT_ROOT'].'/library/classes/');

/*** Standard includes  */
require_once 'config/database.php';
require_once 'config/smarty.php';

require_once 'scrape/simple_html_dom.php';
require_once 'class/spam.php';

//error_reporting(E_ERROR | E_WARNING | E_PARSE);


$link ='http://www.bizcommunity.com/Companies/196/11/service-recruitment/sm-1.html';

function getPage($link) {
	/* Setup curl. */
    $options = array(
        CURLOPT_RETURNTRANSFER 	=> true,     // return web page
        CURLOPT_HEADER         		=> false,    // don't return headers
        CURLOPT_FOLLOWLOCATION 	=> true,     // follow redirects
        CURLOPT_ENCODING       		=> "",       // handle all encodings
        CURLOPT_USERAGENT      		=> "spider", // who am i
        CURLOPT_AUTOREFERER    	=> true,     // set referer on redirect
        CURLOPT_CONNECTTIMEOUT	=> 120,      // timeout on connect
        CURLOPT_TIMEOUT        		=> 120,      // timeout on response
        CURLOPT_MAXREDIRS      		=> 10,       // stop after 10 redirects
    );

    $curl = curl_init($link);
    curl_setopt_array($curl, $options);
    $urlContent = curl_exec($curl);
    curl_close($curl);
	
	/* Clean it up. */
	$curl = NULL; UNSET($curl);
	
	return  $urlContent;
}

/* Object. */
if(trim($link) != '') {
	
    $urlContent = getPage($link);

	/* Get the first DIV in the results page. */
	$maintable = str_get_html($urlContent)->find('.kMainTable', 0)->innertext;
	echo $maintable; exit;
	if($maintable) {
		$results = str_get_html($maintable)->find('table', 2)->innertext;

		
		/* Object. */
		$spamObject = new class_spam();
			
		/* Loop through all the jobs. */
		$counter = 0;
		while(($item = str_get_html($results)->find('tr', $counter)->innertext) != NULL) {
			
			$data = array();
			
			/**************************************************************************************************** CHECK PREMIER CLIENTS FIRST. */
			$contactUsLink = str_get_html($item)->find('.kBrowseCompany-Links a', 0)->href;
			
			if(!$contactUsLink) {
					echo 'here';
				
			}

			exit;

			$counter++;
		}
	}
}
?>