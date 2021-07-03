<?php /* Smarty version 2.6.20, created on 2013-10-01 09:59:53
         compiled from domains/default.tpl */ ?>
<!DOCTYPE html>
<!-- HTML Start -->
<html lang="en">
<!-- Page Head Start -->
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=8" />
    <title>Willow Nettica | Domains</title>
	<meta name="description" content="willow nettica domain registration (.co.za, .com, etc) for clients in east london, cape town, johannesburg, durban and the rest of south africa.">                
	<meta name="keywords" content="willow nettica,  domain registration, .co.za, .com, east london, cape town, johannesburg, durban, rest of south africa">
	<meta name="robots" content="index, follow">
	<meta name="revisit-after" content="21 days">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta property="og:title" content="Willow Nettica"> 
	<meta property="og:image" content="http://www.willow-nettica.co.za/images/willow-nettica.png"> 
	<meta property="og:url" content="http://www.willow-nettica.co.za">
	<meta property="og:site_name" content="Willow Nettica">
	<meta property="og:type" content="website">
	<meta property="og:description" content="willow nettica offers domain registration for .co.za, .com, etc for clients in east london, cape town, johannesburg, durban and the rest of south africa">				
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
            <!-- Two Third Start -->
            <div class="content-two-third-wrapper">
            	<header class="content-two-third-header"></header>
                <div class="content-two-third-background">
                    <div class="content-two-third-body">
                        <h1>Domains</h1>
                        <div class="content-horizontal-rule"></div>
                        <div id="contactarea">
                        <p>Search for a domain below:</p>
                        <p>
							<form id="domainForm" name="domainForm" action="/domains/" method="post">
								<table width="100%">
									<tr>									
										<td valign="top">
											<input type="text" name="domain" id="domain" value="" placeholder="e.g. domainname.co.za" class="contact-input <?php if (isset ( $this->_tpl_vars['error'] )): ?>error<?php endif; ?>">
										</td>
										<td valign="top">
											<input type="button" value="Submit" name="send" onClick="submitForm();" class="contact-submit" style="margin-top: 0 !important; width: 127px !important;">
										</td>
									</tr>
								</table>
								<p class="green"><?php echo $this->_tpl_vars['error']; ?>
</p>
							</form>
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
                        <p>Search for a domain to see if its available or not, before you can start thinking about hosting and create a website.</p>
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
					document.forms.domainForm.submit();					 
				}
			</script>
		'; ?>
		
	
</body>
<!-- Page Body End -->
</html>
<!-- HTML End -->                                     