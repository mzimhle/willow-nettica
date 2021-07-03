<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" xmlns:fb="http://ogp.me/ns/fb#"> <!--<![endif]-->
    <head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<title>Willow-Nettica - Bespoke Development and Software Solutions</title>
		<meta name="description" content="We offer web/mobile design and development, bulk emails and sms, search engine optimization (SEO) and web analytics, social media, branding and marketing.">          
		<meta name="keywords" content="web/mobile design, development, bulk emails, bulk sms, search engine optimization (SEO), web analytics, social media, branding, marketing.">
		<meta name="robots" content="index, follow">
		<meta name="revisit-after" content="21 days">
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta property="og:title" content="Willow-Nettica"> 
		<meta property="og:image" content="http://www.willow-nettica.co.za/img/wn-logo.png"> 
		<meta property="og:url" content="http://www.willow-nettica.co.za">
		<meta property="og:site_name" content="Willow-Nettica: {$newsletterData.newsletter_title}">
		<meta property="og:type" content="website">
		<meta property="og:description" content="{$newsletterData.newsletter_content|normal_text|strip_tags|truncate:100}">
		<meta name="viewport" content="width=device-width">
		{include_php file='includes/javascript.php'}
		{include_php file='includes/css.php'}
    </head>
    <body>
	{include_php file='includes/header.php'}
	    <section id="newsletters">
  	<div class="container" >
    <div class="span12">
    	<div class="title"><h2>Newsletters</h2></div>
    	<div class="fluidrow">
			<div class="sub-title"><h3>{$newsletterData.newsletter_title}</h3></div>
			<div class="sub-date"><h4>{$newsletterData.newsletter_added|date_format:"%A, %B %e, %Y"}</h4></div>
			<p>{$newsletterData.newsletter_content}</p>
			<p>
			{literal}
			<br /><br />
			<fb:comments href="{/literal}http://www.willow-nettica.co.za{$newsletterData.newsletter_link}{literal}" colorscheme="3E3E3E" numposts="20" width="900"></fb:comments>
			<div id="fb-root"></div>
			<script>(function(d, s, id) {
			  var js, fjs = d.getElementsByTagName(s)[0];
			  if (d.getElementById(id)) return;
			  js = d.createElement(s); js.id = id;
			  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=295850523888094";
			  fjs.parentNode.insertBefore(js, fjs);
			}(document, 'script', 'facebook-jssdk'));</script>
			{/literal}				
			</p>
		</div>
    </div>
    	</div>
	</section> 
	<div class="clearfix"></div>
	{include_php file='includes/footer.php'}
    </body>
</html>
