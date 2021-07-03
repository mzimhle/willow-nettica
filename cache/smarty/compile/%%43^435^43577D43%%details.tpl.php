<?php /* Smarty version 2.6.20, created on 2013-09-28 01:11:59
         compiled from admin/archive/scrape/details.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_options', 'admin/archive/scrape/details.tpl', 50, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8" /> 
	<title>Admin | Archive | Scrape </title>
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
					<li><a href="/admin/archive/scrape/">Scrape</a></li>
					<li><a href="#"><?php if (isset ( $this->_tpl_vars['spamData'] )): ?><?php echo $this->_tpl_vars['spamData']['spam_name']; ?>
<?php else: ?>Add New Item<?php endif; ?></a></li>
				</ul>
			</div>
			<div class="section">
				<div class="box">
					<div class="title">
						<?php if (isset ( $this->_tpl_vars['spamData'] )): ?><?php echo $this->_tpl_vars['spamData']['spam_name']; ?>
<?php else: ?>Add New Item<?php endif; ?>
						<span class="hide"></span>
					</div>
					<div class="content">
						<form id="detailsForm" name="detailsForm" action="/admin/archive/scrape/details.php<?php if (isset ( $this->_tpl_vars['spamData'] )): ?>?spamid=<?php echo $this->_tpl_vars['spamData']['pk_spam_id']; ?>
<?php endif; ?>" method="post">
							<div class="row">
								<label>Status</label>
								<div class="right">
								<div class="custom-radio"><input type="radio" <?php if (isset ( $this->_tpl_vars['spamData'] ) && $this->_tpl_vars['spamData']['spam_active'] == 1): ?>checked="checked"<?php endif; ?> id="spam_active" value="1" name="statusbutton"><label for="spam_active" class="checked">Active</label></div> 
								<div class="custom-radio"><input type="radio" <?php if (isset ( $this->_tpl_vars['spamData'] ) && $this->_tpl_vars['spamData']['spam_active'] == 0): ?>checked="checked"<?php endif; ?> id="spam_non_active" value="2" name="statusbutton"><label for="spam_non_active" class="">Non Active</label></div> 
								<div class="custom-radio"><input type="radio"  <?php if (isset ( $this->_tpl_vars['spamData'] ) && $this->_tpl_vars['spamData']['spam_deleted'] == 1): ?>checked="checked"<?php endif; ?> id="spam_deleted" value="3" name="statusbutton"><label for="spam_deleted" class="">Delete</label></div> 
								</div>
							</div>
							<div class="row">
								<label>Spam Type</label>
								<div class="right">
									<?php if (isset ( $this->_tpl_vars['spamtypePairs'] )): ?> 
									<select id="fk_spamType_id" name="fk_spamType_id">
										<option value=""> ---- </option>
										<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['spamtypePairs'],'selected' => $this->_tpl_vars['spamData']['fk_spamType_id']), $this);?>
</td>
									</select>
									<?php else: ?>
										<input type="hidden" id="fk_spamType_id" name="fk_spamType_id" value="" />
										<span class="error">Please add a type</span>
									<?php endif; ?>
								</div>
							</div>							
							<div class="row">
								<label>Name</label>
								<div class="right">
								<input type="text" name="spam_name" id="spam_name" size="40" value="<?php echo $this->_tpl_vars['spamData']['spam_name']; ?>
"  />
								</div>
							</div>
							<div class="row">
								<label>Email</label>
								<div class="right">
									<input type="text" name="spam_email" id="spam_email" size="40" value="<?php echo $this->_tpl_vars['spamData']['spam_email']; ?>
"  />
								</div>
							</div>
							<div class="row">
								<label>Number</label>
								<div class="right">
							<input type="text" name="spam_number" id="spam_number" size="40" value="<?php echo $this->_tpl_vars['spamData']['spam_number']; ?>
"  />
								</div>
							</div>	
							<div class="row">
								<label>Fax</label>
								<div class="right">
							<input type="text" name="spam_fax" id="spam_fax" size="40" value="<?php echo $this->_tpl_vars['spamData']['spam_fax']; ?>
" />
								</div>
							</div>
							<div class="row">
								<label>Link</label>
								<div class="right">
							<input type="text" name="spam_link" id="spam_link" size="40" value="<?php echo $this->_tpl_vars['spamData']['spam_link']; ?>
"  />
								</div>
							</div>
							<div class="row">
								<label>Referer Link</label>
								<div class="right">
									<input type="text" name="spam_referer" id="spam_referer" size="40" value="<?php echo $this->_tpl_vars['spamData']['spam_referer']; ?>
"  />
								</div>
							</div>	
								<div class="section">
									<div class="box">
										<div class="title">
											More Text
											<span class="hide"></span>
										</div>
										<div class="content nopadding">
											<form action="">
													<textarea rows="" name="spam_text" id="spam_text"  cols="" class="wysiwyg" style="height : 500px;"><?php echo $this->_tpl_vars['accountData']['spam_text']; ?>
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