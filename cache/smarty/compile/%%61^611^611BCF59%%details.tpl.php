<?php /* Smarty version 2.6.20, created on 2013-11-11 20:22:43
         compiled from admin/domains/websites/details.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_options', 'admin/domains/websites/details.tpl', 63, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8" /> 
	<title>Admin | Domains | Websits </title>
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
					<li><a href="/admin/domains/">Domains</a></li>
					<li><a href="/admin/domains/websites/">Websites</a></li>
					<li><a href="#"><?php if (isset ( $this->_tpl_vars['domainData'] )): ?> <?php echo $this->_tpl_vars['domainData']['domain_link']; ?>
<?php else: ?>Add New Domain<?php endif; ?></a></li>
				</ul>
			</div>
			<div class="section">
				<div class="box">
					<div class="title">
						<?php if (isset ( $this->_tpl_vars['domainData'] )): ?> <?php echo $this->_tpl_vars['domainData']['domain_link']; ?>
<?php else: ?>Add New Domain<?php endif; ?>
						<span class="hide"></span>
					</div>
					<div class="content">
						<form id="detailsForm" name="detailsForm" action="/admin/domains/websites/details.php<?php if (isset ( $this->_tpl_vars['domainData']['pk_domain_id'] )): ?>?reference=<?php echo $this->_tpl_vars['domainData']['pk_domain_id']; ?>
<?php endif; ?>" method="post"  class="valid" novalidate="novalidate">
							<div class="row">
								<label>Status</label>
								<div class="right">
								<div class="custom-radio"><input type="radio" <?php if (isset ( $this->_tpl_vars['domainData'] ) && $this->_tpl_vars['domainData']['domain_active'] == 1): ?>checked="checked"<?php endif; ?> id="domain_active" value="1" name="statusbutton"><label for="domain_active" class="checked">Active</label></div> 
								<div class="custom-radio"><input type="radio" <?php if (isset ( $this->_tpl_vars['domainData'] ) && $this->_tpl_vars['domainData']['domain_active'] == 0): ?>checked="checked"<?php endif; ?> id="domain_non_active" value="2" name="statusbutton"><label for="domain_non_active" class="">Non Active</label></div> 
								<div class="custom-radio"><input type="radio"  <?php if (isset ( $this->_tpl_vars['domainData'] ) && $this->_tpl_vars['domainData']['domain_deleted'] == 1): ?>checked="checked"<?php endif; ?> id="domain_deleted" value="3" name="statusbutton"><label for="domain_deleted" class="">Delete</label></div> 
								</div>
							</div>							
							<div class="row">
								<label>Link Address</label>
								<div class="right">
									<input type="text" name="domain_link" id="domain_link" size="40" value="<?php echo $this->_tpl_vars['domainData']['domain_link']; ?>
"  <?php echo 'class="{validate:{required:true, messages:{required:\'Please enter link\'}}}"'; ?>
 />
								</div>
							</div>
							<div class="row">
								<label>Contact Name </label>
								<div class="right">
								<input type="text" name="domain_name" id="domain_name" size="40" placeholder="last name, first name"value="<?php echo $this->_tpl_vars['domainData']['domain_name']; ?>
"  <?php echo 'class="{validate:{required:true, messages:{required:\'Please enter name\'}}}"'; ?>
 />
								</div>
							</div>	
							<div class="row">
								<label>Client Name</label>
								<div class="right">
									<?php if (isset ( $this->_tpl_vars['clientPairs'] )): ?> 
									<select id="fk_client_reference" name="fk_client_reference">
										<option value=""> ---- </option>
										<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['clientPairs'],'selected' => $this->_tpl_vars['domainData']['fk_client_reference']), $this);?>
</td>
									</select>
									<?php else: ?>
										<input type="hidden" id="fk_client_reference" name="fk_client_reference" value="" />
										<span class="error">Please add a client before adding a domain.</span>
									<?php endif; ?>
								</div>
							</div>
							<div class="row">
								<label>Linked Account</label>
								<div class="right">
									<?php if (isset ( $this->_tpl_vars['accountPairs'] )): ?> 
									<select id="fk_account_id" name="fk_account_id">
										<option value=""> ---- </option>
										<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['accountPairs'],'selected' => $this->_tpl_vars['domainData']['fk_account_id']), $this);?>
</td>
									</select>
									<?php else: ?>
										<input type="hidden" id="fk_account_id" name="fk_account_id" value="" />
										<span class="error">Please add an account before adding a domain.</span>
									<?php endif; ?>
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
		
	</div>
</div>
</body>
</html> 