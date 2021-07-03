<?php

/* Add this on all pages on top. */
set_include_path($_SERVER['DOCUMENT_ROOT'].'/'.PATH_SEPARATOR.$_SERVER['DOCUMENT_ROOT'].'/library/classes/');

/*** Standard includes  */
require_once 'config/database.php';
require_once 'config/smarty.php';

require_once 'scrape/simple_html_dom.php';
require_once 'class/spam.php';

error_reporting(E_ERROR | E_WARNING | E_PARSE);

$page = array('0-9', 'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z');
$rand = rand(0, count($page));

$link ='http://www.yellowpages.co.za/recruitment_consultants/recruitment_consultants/?Radius=5&alphaPaging='.$page[$rand].'&completeAlphaPaging=0-9ABCDEFGHIJKLMNOPQRSTUVWZ&currentlyDisplayedBusinessNames=Blue%20Pointer%20Trading%20341%20Pty%20Ltd%7CBabereki%20Employee%20Support%20Service%7CBlue%20Nightingale%7CBandulo%20Human%20Development%7CBiz%20Africa%201470%20(Pty)%20Ltd%7CBc%20Labour%20Services%20Cc%7CB%20%26%20M%20Mining%7CB%20%26%20M%20Mining%20Cc%7CBc%20Merchandising%7CBc%20Merchandising%7CBar%20Vallei%20Personeeldienste%7CBilnor%20Construction%20And%20Labour%20Hire%20Cc%7CB%20%26%20D%20Human%20Capital%20Management%20Pty%20Ltd%7CB%20R%20G%20Labour%20Hire&debug=false&displayType=list&fallBackRankProfile=false&firstSearch=false&geoCoordinateLat=&geoCoordinateLong=&geoLevel=&lastFqlQuerySelector=1&location=Eg.Ogies&locationCode=&pageNo=&query=Recruitment%20consultants&searchType=LITA&selectedCategoriesTxt=recruitment%20consultants&taxTerms=recruitment%20consultants%3Bcontract%20recruitment%3Bdomestic%20workers%20recruitment%20agencies%3Bemploment%20agencies%3Bemployement%20agencies%3Bemployment%20advisers%3Bemployment%20agencies%3Bemployment%20agencies%20and%20consultants%3Bemployment%20agency%3Bemployment%20agents%3Bemployment%20consultants%3Bemplyment%20agencies%3Bempolyment%20agencies%3Bgeneralist%20recruitment%3Bjob%20agencies%3Bjob%20agency%3Bjob%20agents%3Bjob%20clubs%3Bjob%20shop%3Bjobagency%3Blabour%20agencies%3Blabour%20agency%3Blabour%20contractors%3Blabour%20contractors%20-%20hire%3Bmobile%20recruitment%20agency%3Bpersonnel%20-%20agency%3Bpersonnel%20agencies%3Bpersonnel%20agency%3Bpersonnel%20agencycrew%20job%20for%20rcuise%20ship%3Brecriutment%20agencies%3Brecruitement%20agencies%3Brecruiting%20agencies%3Brecruitment%20agencies%3Brecruitment%20agency%3Brecruitment%20agents%3Brecruitment%20companies%3Brecruitment%20services%3Brecruitmentagency%3Brecuritment%20agencies%3Bstaff%20agencies%3Bstaff%20agency%3Bstaff%20placements%3Bwork%20agencies%3Bwork%20agency&yprandom=yprandom4';

/* Object. */
if(trim($link) != '') {
	
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

	/* Get the first DIV in the results page. */
	$results = str_get_html($urlContent)->find('#results-list', 0)->innertext;

	/* Object. */
	$spamObject = new class_spam();
		
	/* Loop through all the jobs. */
	$counter = 0;
	while(($item = str_get_html($results)->find('.the_result', $counter)->innertext) != NULL) {
		
		$data = array();
		$data['fk_spamType_id']	= 1;
		$data['spam_referer'] 		= 'http://www.yellowpages.co.za/recruitment_consultants/recruitment_consultants/';
		$data['spam_text'] 			= $item;

		/************************************************************* Fax. */		
		$data['spam_fax']			= trim(str_replace('&nbsp;', '', str_replace(' ', '', str_replace('Fax:', '', str_get_html($item)->find('.details #resultFaxBar', 0)->innertext))));
		/************************************************************* Fax End. */		
		
		/************************************************************* Spam Name. */		
		$data['spam_name']		= str_get_html($item)->find('.resultAddressbar h2 a', 0)->innertext;		
		/************************************************************* Spam Name End. */
		
		/************************************************************* Website. */
		/* Check if they have email. */
		$websiteContent	= str_get_html($item)->find('.details #resultWebsiteBar a', 0)->onclick;	
		$pattern				='/(http|https)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/'; 
		
		/* Pregmatch to find an email address. */
		preg_match_all($pattern, $websiteContent, $matches);
		
		if(count($matches) > 0) {
			for($i = 0; $i < count($matches); $i++) {
				if(isset($matches[$i][0])) {
					if(preg_match($pattern, str_replace(' ', '', $matches[$i][0]))) {
						$data['spam_link'] =  $matches[$i][0];
					}			
				}
			}
		}
		
		$numberContent = $pattern = $matches = $i = null;
		unset($numberContent, $pattern, $matches, $i);		
		/************************************************************* Website End. */		
		
		/************************************************************* Number. */
		/* Check if they have email. */
		$numberContent	= str_get_html($item)->find('.details #resultTelBar span', 0)->onclick;	
		$pattern				="/[(][0-9]{3}[)][\-][0-9]{6}|[0-9]{3}[\s][0-9]{6}|[0-9]{3}[\s][0-9]{3}[\s][0-9]{4}|[0-9]{10}|[0-9]{3}[\-][0-9]{3}[\-][0-9]{4}/"; 
		
		/* Pregmatch to find an email address. */
		preg_match_all($pattern, $numberContent, $matches);
		
		if(count($matches) > 0) {
			for($i = 0; $i < count($matches); $i++) {
				if(isset($matches[$i][0])) {
					if(preg_match($pattern, $matches[$i][0])) {
						$data['spam_number'] =  str_replace(' ', '', $matches[$i][0]);
					}			
				}
			}
		}
		
		$numberContent = $pattern = $matches = $i = null;
		unset($numberContent, $pattern, $matches, $i);
		
		/************************************************************* Number End. */
		/************************************************************* Email. */
		/* Check if they have email. */
		$emailContent	= str_get_html($item)->find('.details #resultEmailBar a', 0)->onclick;	
		$pattern			="/[a-z0-9]+([_\\.-][a-z0-9]+)*@([a-z0-9]+([\.-][a-z0-9]+)*)+\\.[a-z]{2,}/i"; 
		
		/* Pregmatch to find an email address. */
		preg_match_all($pattern, $emailContent, $matches);
		
		if(count($matches) > 0) {
			for($i = 0; $i < count($matches); $i++) {
				if(isset($matches[$i][0])) {
					if(preg_match('/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/', $matches[$i][0])) {
						$data['spam_email'] =  $matches[$i][0];
					}			
				}
			}
		}
		
		$emailContent = $pattern = $matches = $i = null;
		unset($numberContent, $pattern, $matches, $i);
		/************************************************************* Email End. */
		
		$checkData = array();
		
		if(isset($data['spam_email']) && trim($data['spam_email']) != '') {
			$checkData = $spamObject->getByEmail($data['spam_email']);
		} else if(isset($data['spam_fax']) && trim($data['spam_fax']) != '') {
			$checkData = $spamObject->getByFax($data['spam_fax']);
		} else if(isset($data['spam_name']) && trim($data['spam_name']) != '') {
			$checkData = $spamObject->getByName($data['spam_name']);
		}
		
		if(count($checkData) > 0 && isset($checkData['spam_name'])) {		
			echo '<span style="color: red; font-weight: bold;">Aready exists: '.$data['spam_name'].' '.$data['spam_email'].' '.$data['spam_fax'].'</span><br />';
		} else {
			echo '<span style="color: green; font-weight: bold;">Added: '.$data['spam_name'].' '.$data['spam_email'].' '.$data['spam_fax'].'</span><br />';
			$spamObject->insert($data);
		}


		$counter++;
	}
}

?>