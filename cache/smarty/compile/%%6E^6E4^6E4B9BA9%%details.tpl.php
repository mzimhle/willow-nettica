<?php /* Smarty version 2.6.20, created on 2013-10-19 15:34:45
         compiled from admin/newsletters/details.tpl */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8" /> 
	<title>Admin | Newsletters</title>
	<meta name="apple-mobile-web-app-capable" content="no" />
	<meta name="apple-mobile-web-app-status-bar-style" content="black" />
	<meta name="viewport" content="width=device-width,initial-scale=0.69,user-scalable=yes,maximum-scale=1.00" />
	<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'admin/includes/css.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

	<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'admin/includes/javascript.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

</head>
<body>
<div id="wrapper">
	<div id="container">
		<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'admin/includes/header.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

		<div id="left">
			<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'admin/includes/sidemenu.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

		</div>
		<div id="right">
			<div id="breadcrumbs">
				<ul>
					<li></li>
					<li><a href="/admin/">Home</a></li>
					<li><a href="/admin/newsletters/">Newsletter</a></li>
					<li><a href="#"><?php if (isset ( $this->_tpl_vars['newsletterData'] )): ?><?php echo $this->_tpl_vars['newsletterData']['account_name']; ?>
<?php else: ?>Add New Newsletter<?php endif; ?></a></li>
				</ul>
			</div>
			<div class="section">
				<div class="box">
					<div class="title">
						<?php if (isset ( $this->_tpl_vars['newsletterData'] )): ?><?php echo $this->_tpl_vars['newsletterData']['account_name']; ?>
<?php else: ?>Add New Newsletter<?php endif; ?>
						<span class="hide"></span>
					</div>
					<div class="content">
						<form id="detailsForm" name="detailsForm" action="/admin/newsletters/details.php<?php if (isset ( $this->_tpl_vars['newsletterData'] )): ?>?reference=<?php echo $this->_tpl_vars['newsletterData']['newsletter_reference']; ?>
<?php endif; ?>" method="post">
							<div class="row">
							<label>Status</label>
							<div class="right">
							<div class="custom-radio"><input type="radio" <?php if (isset ( $this->_tpl_vars['newsletterData'] ) && $this->_tpl_vars['newsletterData']['newsletter_active'] == 1): ?>checked="checked"<?php endif; ?> id="newsletter_active" value="1" name="statusbutton"><label for="newsletter_active" class="checked">Active</label></div> 
							<div class="custom-radio"><input type="radio" <?php if (isset ( $this->_tpl_vars['newsletterData'] ) && $this->_tpl_vars['newsletterData']['newsletter_active'] == 0): ?>checked="checked"<?php endif; ?> id="newsletter_non_active" value="2" name="statusbutton"><label for="newsletter_non_active" class="">Non Active</label></div> 
							<div class="custom-radio"><input type="radio"  <?php if (isset ( $this->_tpl_vars['newsletterData'] ) && $this->_tpl_vars['newsletterData']['newsletter_deleted'] == 1): ?>checked="checked"<?php endif; ?> id="newsletter_deleted" value="3" name="statusbutton"><label for="newsletter_deleted" class="">Delete</label></div> 
							</div>
							</div>							
							<div class="row">
								<label>Title</label>
								<div class="right">
									<input type="text" name="newsletter_title" id="newsletter_title" size="40" value="<?php echo $this->_tpl_vars['newsletterData']['newsletter_title']; ?>
"/>
								</div>
							</div>	
							<div class="section">
								<div class="box">
									<div class="title">
										Newsletter
										<span class="hide"></span>
									</div>
									<div class="content nopadding">
										<form action="">
												<textarea rows="" name="newsletter_content" id="newsletter_content"  cols="" class="wysiwyg" style="height : 1000px;"><?php echo $this->_tpl_vars['newsletterData']['newsletter_content']; ?>
</textarea>
										</form>
									</div>
								</div>
							</div>						
							<div class="row">
								<label></label>
								<div class="right">
									<button type="submit" onclick="submitForm()"><span>Sumbit</span></button>							
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'admin/includes/footer.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

		<?php echo '
		<script type="text/javascript">
			function submitForm() {
				document.forms.detailsForm.submit();					 
			}
		</script>
		'; ?>
				
	</div>
</div>
</body>
</html> 