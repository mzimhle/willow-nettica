<?php /* Smarty version 2.6.20, created on 2013-10-07 22:54:21
         compiled from contact-us/default.tpl */ ?>
<!DOCTYPE html>
<!-- HTML Start -->
<html lang="en">
<!-- Page Head Start -->
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=8" />
    <title>Willow Nettica | Contact Us</title>
	<meta name="description" content="willow nettica contact us even if you are in east london, cape town, johannesburg, durban and the rest of south africa.">                
	<meta name="keywords" content="willow nettica, contact us, east london, cape town, johannesburg, durban, rest of south africa">
	<meta name="robots" content="index, follow">
	<meta name="revisit-after" content="21 days">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta property="og:title" content="Willow Nettica"> 
	<meta property="og:image" content="http://www.willow-nettica.co.za/images/willow-nettica.png"> 
	<meta property="og:url" content="http://www.willow-nettica.co.za">
	<meta property="og:site_name" content="Willow Nettica">
	<meta property="og:type" content="website">
	<meta property="og:description" content="willow nettica contact us even if you are  for clients in east london, cape town, johannesburg, durban and the rest of south africa">			
	<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'includes/javascript.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

	<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'includes/css.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

</head>
<!-- Page Head End -->
<!-- Page Body Start -->
<body>
    <div id="background-greenbar"></div>	
    <!-- Page Wrapper Start -->
    <div id="page-wrapper">
	<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'includes/header.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

        <div class="content-wrapper">
		<?php if (isset ( $this->_tpl_vars['success'] )): ?>
        <!-- Promotion Bar Start -->
        <div id="bar-invisible-wrapper">
            <section id="promotion-bar">
                <div id="bar-tick"></div>
            	<div class="bar-left-text"><span class="green">Success:</span> Your enquiry has been successfully sent, we will get back to you as soon as we can.</div>
            	<a href="#" class="bar-cross"></a>
            </section>
        </div>
        <!-- Promotion Bar End -->		
		<?php endif; ?>
            <!-- Two Third Start -->
            <div class="content-two-third-wrapper">
            	<header class="content-two-third-header"></header>
                <div class="content-two-third-background">
                    <div class="content-two-third-body">
                        <h1>Contact Us</h1>
                        <div class="content-horizontal-rule"></div>
                        <div id="contactarea">
                        <p>Please use the form below to contact us.</p>
                        <p>
							<form id="contactForm" name="contactForm" action="/contact-us/" method="post">
								<table width="580" cellpadding="0" cellspacing="0">
									<tr>
										<td width="61">Full Name</td>
										<td width="176"><input type="text" name="enquiry_name" id="enquiry_name" value="<?php echo $this->_tpl_vars['enquiryData']['enquiry_name']; ?>
" placeholder="e.g. name surname" class="contact-input <?php if (isset ( $this->_tpl_vars['errorMessages']['enquiry_name'] )): ?>error<?php endif; ?>"></td>
									</tr>
									<tr><td colspan="2">&nbsp;</td></tr>
									<tr>
										<td width="78" >Email</td>
										<td width="245"><input type="text" name="enquiry_email" id="enquiry_email" value="<?php echo $this->_tpl_vars['enquiryData']['enquiry_email']; ?>
" placeholder="e.g. name@domain.com"  class="contact-input <?php if (isset ( $this->_tpl_vars['errorMessages']['enquiry_email'] )): ?>error<?php endif; ?>"></td>								
									</tr>
									<tr><td colspan="2">&nbsp;</td></tr>
									<tr>
										<td width="78" >Number</td>
										<td width="245"><input type="text" name="enquiry_number" id="enquiry_number" value="<?php echo $this->_tpl_vars['enquiryData']['enquiry_number']; ?>
" placeholder="e.g. 0735654825" class="contact-input <?php if (isset ( $this->_tpl_vars['errorMessages']['enquiry_number'] )): ?>error<?php endif; ?>"></td>								
									</tr>	
									<tr><td colspan="2">&nbsp;</td></tr>									
									<tr>
										<td>Message</td>
										<td><textarea rows="10" name="enquiry_comments" id="enquiry_comments" value="<?php echo $this->_tpl_vars['enquiryData']['enquiry_comments']; ?>
" class="contact-message <?php if (isset ( $this->_tpl_vars['errorMessages']['enquiry_comments'] )): ?>error<?php endif; ?>"></textarea></td>
									</tr>
									<tr><td colspan="2">&nbsp;</td></tr>
									<tr>
										<td></td>
										<td><input type="button" value="Submit" name="send" onClick="submitForm();" class="contact-submit"></td>
									</tr>
								</table>
							</form>
					</p>
                    </div>
                    </div>
                </div>
                <div class="content-two-third-footer"></div>
            </div>
            <!-- Two Third End -->
            <!-- One Third Start -->
            <div class="content-second-one-third-wrapper">
            	<header class="content-one-third-header"></header>
                <div class="content-one-third-background">
                    <div class="content-one-third-body">
                        <h1>Please Note</h1>
                        <div class="content-horizontal-rule"></div>
                        <p>Contact us and we will get back to you as soon as we can, enquiry about web development, hosting, domain registration, etc.</p>
                    </div>
                </div>
                <div class="content-one-third-footer"></div>
            </div>
            <!-- One Third End -->
        </div>
		<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'includes/footer.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

    </div>
    <!-- Page Wrapper End -->
		<?php echo '
			<script type="text/javascript">	
				function submitForm() {
					document.forms.contactForm.submit();					 
				}
			</script>
		'; ?>
		
	
</body>
<!-- Page Body End -->
</html>
<!-- HTML End -->                                     