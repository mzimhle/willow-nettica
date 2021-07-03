<?php
/* Add this on all pages on top. */
set_include_path($_SERVER['DOCUMENT_ROOT'].'/'.PATH_SEPARATOR.$_SERVER['DOCUMENT_ROOT'].'/library/classes/');

require_once('config/database.php');
require_once('class/social.php');

$title = 'Willow Nettica -  Deliver functional online solutions';
$keywords = 'web, design, development, front-end, branding, content management, bulk email, bulk sms, html5, responsive, SME, invoicing, online';
$description = 'Willow-Nettica was founded not only to produce well-designed websites and powerful branding, but to provide remarkably efficient online solutions that deliver results.';

$socialObject = new class_social();

$socialData = $socialObject->getAll();

include 'header.php';
?>
<div id="fb-root"></div>
<script type="text/javascript">
/* 

http://stackoverflow.com/questions/7818667/simple-example-to-post-to-a-facebook-fan-page-via-php

*/
(function(d){
   var js, id = 'facebook-jssdk'; if (d.getElementById(id)) {return;}
   js = d.createElement('script'); js.id = id; js.async = true;
   js.src = "//connect.facebook.net/en_US/all.js";
   d.getElementsByTagName('head')[0].appendChild(js);
}(document));
 
window.fbAsyncInit = function() {
  FB.init({
	appId      : '295850523888094',
	status     : true, 
	cookie     : true,
	xfbml      : true,
	oauth      : true,
  });
	FB.Event.subscribe('auth.login', function () {
		  window.location = window.location.href;
	  });
};
 
function fb_login(){
	FB.login(function(response) {

		if (response.authResponse) {
		
			access_token = response.authResponse.accessToken; //get access token
			user_id = response.authResponse.userID; //get FB UID

			FB.api('/me?fileds=manage_pages', function(response) {
			
				$.ajax({
					type: "GET",
					url: "demo/socialmedia/write-on-page/default.php",
					data: {
						ajax: 'fb',
						id: response.id,
						email: response.email,
						first_name: response.first_name,
						last_name: response.last_name,
						gender: response.gender,
						link: response.link
					},
					dataType: "json",
					success: function(data){						
							
						if(data.result == 1) {
							window.location = '/demo/socialmedia/write-on-page/';
						} else {							
							alert(data.message);
						}						
					}
				});
			});

		} else {

		}
	}, {
		scope: 'manage_pages'
	});
}
</script>
<section class="section" id="section0" style="height: 10% !important;">
	<div class="topbar">
		<div class="row wrap">
			<div class="small-6 large-6 columns logobox"><a href="/"><img src="/img/logo_big.png" alt="Willow Nettica" title="Willow Nettica" /></a></div>
			<nav class="small-6 large-6 columns topnav cl-effect-5">
				<ul class="inline-list linkside right">
					<li><a data-menuanchor="home" href="/index" class="homebtn"><span data-hover="Home">Home</span></a></li>
					<li><a href="/services" class="servbtn"><span data-hover="Services">Services</span></a></li>
					<li><a href="/portfolio" class="portbtn"><span data-hover="Portfolio">Portfolio</span></a></li>
					<li><a href="/contacts" class="contbtn"><span data-hover="Contacts">Contacts</span></a></li>
				</ul>
			</nav>
		</div>
	</div>
</section>
<section id="home">
    <div class="lgreybox">
    	<div class="hstxt hltxt">
            <div class="wrap" style="color: black;">
                <h3>Writing on a page or twitter account</h3>
				<p><a href="#" onclick="fb_login();" style="color: black;">Facebook Permissions</a></p>
				<br /><br />
				<p><a href="twitter.php" >Twitter</a></p>
				<table>
				<?php
				if($socialData) {
				foreach($socialData as $item) {
					echo '<tr>';
					echo '<td>'.$item['social_username'].'</td>'; 
					echo '<td>'.$item['social_name'].'</td>'; 
					echo '<td>'.$item['social_location'].'</td>'; 
					echo '<td>'.$item['social_followers'].'"</td>'; 
					echo '<td><img src="'.$item['social_image'].'" /></td>'; 					
					echo '</tr>';
				}
				} else {
					echo '<tr><td>There are no items</td></tr>';
				}
				?>
				</table>
            </div>
		</div>
    </div>
</section>
<?php include 'footer.php'; ?>