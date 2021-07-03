<?php /* Smarty version 2.6.20, created on 2013-11-11 11:28:14
         compiled from admin/accounts/logins/details.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_options', 'admin/accounts/logins/details.tpl', 51, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8" /> 
	<title>Admin | Accounts | Logins </title>
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
					<li><a href="/admin/accounts/">Accounts</a></li>
					<li><a href="/admin/accounts/logins/">Logins</a></li>
					<li><a href="#"><?php if (isset ( $this->_tpl_vars['accountData'] )): ?><?php echo $this->_tpl_vars['accountData']['account_name']; ?>
<?php else: ?>Add New Account<?php endif; ?></a></li>
				</ul>
			</div>
			<div class="section">
				<div class="box">
					<div class="title">
						<?php if (isset ( $this->_tpl_vars['accountData'] )): ?><?php echo $this->_tpl_vars['accountData']['account_name']; ?>
<?php else: ?>Add New Account<?php endif; ?>
						<span class="hide"></span>
					</div>
					<div class="content">
						<form id="detailsForm" name="detailsForm" action="/admin/accounts/logins/details.php<?php if (isset ( $this->_tpl_vars['accountData'] )): ?>?reference=<?php echo $this->_tpl_vars['accountData']['pk_account_id']; ?>
<?php endif; ?>" method="post">
							<div class="row">
							<label>Status</label>
							<div class="right">
							<div class="custom-radio"><input type="radio" <?php if (isset ( $this->_tpl_vars['accountData'] ) && $this->_tpl_vars['accountData']['account_active'] == 1): ?>checked="checked"<?php endif; ?> id="account_active" value="1" name="statusbutton"><label for="account_active" class="checked">Active</label></div> 
							<div class="custom-radio"><input type="radio" <?php if (isset ( $this->_tpl_vars['accountData'] ) && $this->_tpl_vars['accountData']['account_active'] == 0): ?>checked="checked"<?php endif; ?> id="account_non_active" value="2" name="statusbutton"><label for="account_non_active" class="">Non Active</label></div> 
							<div class="custom-radio"><input type="radio"  <?php if (isset ( $this->_tpl_vars['accountData'] ) && $this->_tpl_vars['accountData']['account_deleted'] == 1): ?>checked="checked"<?php endif; ?> id="account_deleted" value="3" name="statusbutton"><label for="account_deleted" class="">Delete</label></div> 
							</div>
							</div>							
							<div class="row">
								<label>Client Account</label>
								<div class="right">
									<?php if (isset ( $this->_tpl_vars['clientPairs'] )): ?> 
									<select id="fk_client_reference" name="fk_client_reference">
										<option value=""> ---- </option>
										<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['clientPairs'],'selected' => $this->_tpl_vars['accountData']['fk_client_reference']), $this);?>
</td>
									</select>
									<?php else: ?>
										<input type="hidden" id="fk_client_reference" name="fk_client_reference" value="" />
										<span class="error">Please add a client before adding a recovery account.</span>
									<?php endif; ?>
								</div>
							</div>
							<div class="row">
								<label>Account Name</label>
								<div class="right">
									<input type="text" name="account_name" id="account_name" size="40" value="<?php echo $this->_tpl_vars['accountData']['account_name']; ?>
"/>
								</div>
							</div>
							<div class="row">
								<label>Username / Email</label>
								<div class="right">
								<input type="text" name="account_username" id="account_username" size="40" value="<?php echo $this->_tpl_vars['accountData']['account_username']; ?>
" />
								</div>
							</div>	
							<div class="row">
								<label>Password</label>
								<div class="right">
								<input type="text" name="account_password" id="account_password" size="40" value="<?php echo $this->_tpl_vars['accountData']['account_password']; ?>
" />
								</div>
							</div>
							<div class="row">
								<label>Web Link</label>
								<div class="right">
								<input type="text" name="account_link" id="account_link" size="40" value="<?php echo $this->_tpl_vars['accountData']['account_link']; ?>
" />
								</div>
							</div>
							<div class="row">
								<label>Recovery</label>
								<div class="right">
								<?php if (isset ( $this->_tpl_vars['accountPairs'] )): ?> 
								<select id="fk_recovery_account" name="fk_recovery_account">
									<option value=""> ---- </option>
									<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['accountPairs'],'selected' => $this->_tpl_vars['accountData']['fk_recovery_account']), $this);?>
</td>
								</select>
								<?php else: ?>
									<input type="hidden" id="fk_recovery_account" name="fk_recovery_account" value="" />
									<span class="error">Please add an account before adding a recovery account.</span>
								<?php endif; ?>
								</div>
							</div>
								<div class="section">
									<div class="box">
										<div class="title">
											Description
											<span class="hide"></span>
										</div>
										<div class="content nopadding">
											<form action="">
													<textarea rows="" name="account_description" id="account_description"  cols="" class="wysiwyg" style="height : 500px;"><?php echo $this->_tpl_vars['accountData']['account_description']; ?>
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