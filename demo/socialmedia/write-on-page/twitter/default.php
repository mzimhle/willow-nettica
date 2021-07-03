<?php
/* Add this on all pages on top. */
set_include_path($_SERVER['DOCUMENT_ROOT'].'/'.PATH_SEPARATOR.$_SERVER['DOCUMENT_ROOT'].'/library/classes/');

require_once('config/database.php');

require_once('class/social.php');

require_once 'twitteroauth.php';
require_once('social_functions.php');

$socialObject = new class_social();

if(count($_POST) > 0) {
	
	$errormessage = '';
	
	if(isset($_POST['tweetmessage']) && trim($_POST['tweetmessage']) != '') {
		
		if(strlen(trim($_POST['tweetmessage'])) > 0 and strlen(trim($_POST['tweetmessage'])) < 141) {
			if(isset($_POST['twitter_code']) && trim($_POST['twitter_code']) != '') {
				
				$code = trim($_POST['twitter_code']);
				$MESSAGE = trim($_POST['twitter_code']);
				
				$socialData = $socialObject->getByCode($code);
				
				if($socialData) {

					$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $socialData['social_auth_token'], $socialData['social_auth_secret']);
					
					$parameters = array('status' => trim($_POST['tweetmessage']));
					
					$status = $connection->post('statuses/update', $parameters);
					
					if(!isset($status->errors)) {
						echo '<p style="color: green;">Message was successfully sent, please click here to check the message: <b><a href="https://twitter.com/'.$socialData['social_username'].'" target="_blank">https://twitter.com/'.$socialData['social_username'].'</a></b></p>';
					} else {
						echo '<p style="color: red; font-weight: bold;">Error: '.$status->errors['message'].'</p>';
					}
					
				} else {
					$errormessage .= 'Please select twitter user.<br />';
				}
			} else {
				$errormessage .= 'Please select twitter user.<br />';
			}
		} else {
			$errormessage .= 'Please make sure the message is between 1 and 140 characters long.<br />';
		}
	} else {
		$errormessage .= 'Please add a message to tweet.<br />';
	}
	
	if($errormessage != '') {
		echo '<p style="color: red; font-weight: bold;">Error: '.$errormessage.'</p>';
	}
}

$socialData = $socialObject->getAll();

?>
<style type="text/css">
.success {
	color: green;
	display: block;
	font-weight: bold;
}
.error {
    color: #b90000;
    font-weight: bold;
}
</style>
<p><a href="twitter.php">Log into Twitter</a></p>
<form id="twitterForm" name="twitterForm" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
<p>Select Twitter user</p>
<p></p>
<select id="twitter_code" name="twitter_code">
<?php
if($socialData) {

	echo '<option value=""> --- </option>';
	
	foreach($socialData as $item) {
		echo '<option value="'.$item['social_code'].'">'.$item['social_username'].'</option>';
	}
}
?>
</select>
<p>Write message</p>
<textarea cols="30" rows="5" name="tweetmessage" id="tweetmessage"></textarea><br />
<p id="charcount" class="error">0 characters entered.</p>
<input type="submit" value="Send Tweet" />
</form>
<script src="/js/vendor/jquery-1.10.2.js"></script>
<script type="text/javascript">
$(document).ready(function() {	

	$("#tweetmessage").keyup(function () {
		var i = $("#tweetmessage").val().length;
		$("#charcount").html(i+' characters entered.');
		if (i > 140) {
			$('#charcount').removeClass('success');
			$('#charcount').addClass('error');
		} else if(i == 0) {
			$('#charcount').removeClass('success');
			$('#charcount').addClass('error');
		} else {
			$('#charcount').removeClass('error');
			$('#charcount').addClass('success');
		} 
	});	
});
</script>