<?php 

/* Add this on all pages on top. */
set_include_path($_SERVER['DOCUMENT_ROOT'].'/'.PATH_SEPARATOR.$_SERVER['DOCUMENT_ROOT'].'/library/classes/');
/* include the Zend class for Authentification */

/* Start session and load library. */
require_once('Zend/Session.php');

require_once 'config/database.php';

require_once('twitteroauth.php');
require_once('social_functions.php');

$zfsession = new Zend_Session_Namespace('socialmedia');

if(!empty($_GET['oauth_verifier']) && !empty($zfsession->oauth_token) && !empty($zfsession->oauth_token_secret)){

	/* TwitterOAuth instance, with two new parameters we got in twitter_login.php */
	$twitteroauth = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $zfsession->oauth_token, $zfsession->oauth_token_secret);

	/* Let's request the access token */
	$access_token = $twitteroauth->getAccessToken($_GET['oauth_verifier']);

	/* Save it in a session var */
	$zfsession->access_token = $access_token;

	/* Let's get the user's info */
	$user_info = $twitteroauth->get('account/verify_credentials');

	/* Save the data if its not present. */ 
	if(!isset($user_info->errors)) {

		/* Get classese and objects. */
		require_once 'class/social.php';

		/* Get Object. */
		$socialObject 			= new class_social();

		/* Check if user already exists. check by ID. */
		$twitterData = $socialObject->getBySocial(trim($user_info->id), 'TWITTER');

		/* insert if not present. */
		if(!$twitterData) {

			/* Build data. */
			$data 	= array();	
			$data['social_type'] 			= 'TWITTER';
			$data['social_id']				= $zfsession->access_token['user_id'];
			$data['social_name']			= isset($user_info->name) && trim($user_info->name) != '' ? trim($user_info->name) : null;
			$data['social_username']	= isset($user_info->screen_name) && trim($user_info->screen_name) != '' ? trim($user_info->screen_name) : null;
			$data['social_image']			= isset($user_info->profile_image_url) && trim($user_info->profile_image_url) != '' ? trim($user_info->profile_image_url) : null;
			$data['social_location']		= isset($user_info->location) && trim($user_info->location) != '' ? trim($user_info->location) : null;
			$data['social_followers']		= isset($user_info->followers_count) && trim($user_info->followers_count) != '' ? trim($user_info->followers_count) : null;
			$data['social_auth_token']	= $zfsession->access_token['oauth_token'];
			$data['social_auth_secret']	= $zfsession->access_token['oauth_token_secret'];
			
			/* Insert the data. */ 
			$socialObject->insert($data);
			
		} else {
		
			/* Update "last login" */
			$data 	= array();
			$data['social_name']			= isset($user_info->name) && trim($user_info->name) != '' ? trim($user_info->name) : null;
			$data['social_username']	= isset($user_info->screen_name) && trim($user_info->screen_name) != '' ? trim($user_info->screen_name) : null;
			$data['social_image']			= isset($user_info->profile_image_url) && trim($user_info->profile_image_url) != '' ? trim($user_info->profile_image_url) : null;
			$data['social_location']		= isset($user_info->location) && trim($user_info->location) != '' ? trim($user_info->location) : null;
			$data['social_followers']		= isset($user_info->followers_count) && trim($user_info->followers_count) != '' ? trim($user_info->followers_count) : null;
			$data['social_auth_token']	= $zfsession->access_token['oauth_token'];
			$data['social_auth_secret']	= $zfsession->access_token['oauth_token_secret'];
			
			$where = array();
			
			$where[] = $socialObject->getAdapter()->quoteInto('social_id = ?', trim($user_info->id));
			$where[] = $socialObject->getAdapter()->quoteInto('social_code = ?', $twitterData['social_code']);
			$socialObject->update($data, $where);	
		
		}

		/* Clean up. */
		$socialObject = $data = $where = $user_info = $access_token = $twitteroauth = NULL;
		UNSET($socialObject, $data, $where, $user_info, $access_token, $twitteroauth);
		
		header('Location: /demo/socialmedia/write-on-page/twitter/');
		exit;
		
	} else {
		print_r($user_info->errors);
		exit;	
	}

} else {
	/* Clean up. */
	$zfsession = NULL; UNSET($zfsession);
}
?>