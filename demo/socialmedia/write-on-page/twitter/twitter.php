<?php 

/*

http://www.9lessons.info/2014/04/twitter-oauth-status-update-using-php.html

*/

/* Add this on all pages on top. */
set_include_path($_SERVER['DOCUMENT_ROOT'].'/'.PATH_SEPARATOR.$_SERVER['DOCUMENT_ROOT'].'/library/classes/');
/* include the Zend class for Authentification */

/* Start session and load library. */
require_once('Zend/Session.php');

require_once('config/database.php');

require_once('twitteroauth.php');

/* Start session and load library. */
require_once('social_functions.php');

$zfsession = new Zend_Session_Namespace('socialmedia');

/* Build TwitterOAuth object with client credentials. */
$twitteroauth = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, 'http://www.willow-nettica.co.za/demo/socialmedia/write-on-page/twitter/twitter_success.php');

/* Get temporary credentials. */
$request_token = $twitteroauth->getRequestToken();

/* Save temporary credentials to session. */
$zfsession->oauth_token			= $request_token['oauth_token'];
$zfsession->oauth_token_secret	= $request_token['oauth_token_secret'];
 
/* If everything goes well.. */
if($twitteroauth->http_code==200) {
	
    /* Let's generate the URL and redirect */
    $url = $twitteroauth->getAuthorizeURL($request_token['oauth_token']);
    header('Location: '.$url);
	exit;
	
} else {
	/* Clean up. */
	$zfsession = $twitteroauth = $request_token = NULL; 
	UNSET($zfsession, $twitteroauth, $request_token);
}



?>