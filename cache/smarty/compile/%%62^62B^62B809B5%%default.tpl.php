<?php /* Smarty version 2.6.20, created on 2014-04-02 02:36:37
         compiled from newsletters/default.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'normal_text', 'newsletters/default.tpl', 20, false),array('modifier', 'strip_tags', 'newsletters/default.tpl', 20, false),array('modifier', 'truncate', 'newsletters/default.tpl', 20, false),array('modifier', 'date_format', 'newsletters/default.tpl', 33, false),)), $this); ?>
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
		<meta property="og:site_name" content="Willow-Nettica: <?php echo $this->_tpl_vars['newsletterData']['newsletter_title']; ?>
">
		<meta property="og:type" content="website">
		<meta property="og:description" content="<?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['newsletterData']['newsletter_content'])) ? $this->_run_mod_handler('normal_text', true, $_tmp) : smarty_modifier_normal_text($_tmp)))) ? $this->_run_mod_handler('strip_tags', true, $_tmp) : smarty_modifier_strip_tags($_tmp)))) ? $this->_run_mod_handler('truncate', true, $_tmp, 100) : smarty_modifier_truncate($_tmp, 100)); ?>
">
		<meta name="viewport" content="width=device-width">
		<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'includes/javascript.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

		<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'includes/css.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

    </head>
    <body>
	<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'includes/header.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

	    <section id="newsletters">
  	<div class="container" >
    <div class="span12">
    	<div class="title"><h2>Newsletters</h2></div>
    	<div class="fluidrow">
			<div class="sub-title"><h3><?php echo $this->_tpl_vars['newsletterData']['newsletter_title']; ?>
</h3></div>
			<div class="sub-date"><h4><?php echo ((is_array($_tmp=$this->_tpl_vars['newsletterData']['newsletter_added'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%A, %B %e, %Y") : smarty_modifier_date_format($_tmp, "%A, %B %e, %Y")); ?>
</h4></div>
			<p><?php echo $this->_tpl_vars['newsletterData']['newsletter_content']; ?>
</p>
			<p>
			<?php echo '
			<br /><br />
			<fb:comments href="'; ?>
http://www.willow-nettica.co.za<?php echo $this->_tpl_vars['newsletterData']['newsletter_link']; ?>
<?php echo '" colorscheme="3E3E3E" numposts="20" width="900"></fb:comments>
			<div id="fb-root"></div>
			<script>(function(d, s, id) {
			  var js, fjs = d.getElementsByTagName(s)[0];
			  if (d.getElementById(id)) return;
			  js = d.createElement(s); js.id = id;
			  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=295850523888094";
			  fjs.parentNode.insertBefore(js, fjs);
			}(document, \'script\', \'facebook-jssdk\'));</script>
			'; ?>
				
			</p>
		</div>
    </div>
    	</div>
	</section> 
	<div class="clearfix"></div>
	<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'includes/footer.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

    </body>
</html>