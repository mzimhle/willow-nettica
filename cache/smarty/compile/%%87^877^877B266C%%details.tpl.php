<?php /* Smarty version 2.6.20, created on 2013-07-04 13:56:47
         compiled from admin/archive/services/details.tpl */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8" /> 
	<title>Admin | Archive | Services </title>
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
					<li><a href="/admin/archive/">Archive</a></li>
					<li><a href="/admin/archive/services/">Services</a></li>
					<li><a href="#"><?php if (isset ( $this->_tpl_vars['serviceData'] )): ?><?php echo $this->_tpl_vars['serviceData']['service_name']; ?>
<?php else: ?>Add New Service Provider<?php endif; ?></a></li>
				</ul>
			</div>
			<div class="section">
				<div class="box">
					<div class="title">
						<?php if (isset ( $this->_tpl_vars['serviceData'] )): ?><?php echo $this->_tpl_vars['serviceData']['service_name']; ?>
<?php else: ?>Add New Service Provider<?php endif; ?>
						<span class="hide"></span>
					</div>
					<div class="content">
						<form id="detailsForm" name="detailsForm" action="/admin/archive/services/details.php<?php if (isset ( $this->_tpl_vars['serviceData'] )): ?>?reference=<?php echo $this->_tpl_vars['serviceData']['service_reference']; ?>
<?php endif; ?>" method="post">
							<div class="row">
								<label>Service Name</label>
								<div class="right">
									<input type="text" name="service_name" id="service_name" size="40" value="<?php echo $this->_tpl_vars['serviceData']['service_name']; ?>
"/>
								</div>
							</div>
							<div class="row">
								<label>Username / Email</label>
								<div class="right">
								<input type="text" name="service_username" id="service_username" size="40" value="<?php echo $this->_tpl_vars['serviceData']['service_username']; ?>
" />
								</div>
							</div>	
							<div class="row">
								<label>Password</label>
								<div class="right">
								<input type="text" name="service_password" id="service_password" size="40" value="<?php echo $this->_tpl_vars['serviceData']['service_password']; ?>
" />
								</div>
							</div>
							<div class="row">
								<label>Web Link</label>
								<div class="right">
								<input type="text" name="service_link" id="service_link" size="40" value="<?php echo $this->_tpl_vars['serviceData']['service_link']; ?>
" />
								</div>
							</div>
							<div class="row">
								<label>Items Remaining</label>
								<div class="right">
								<input type="text" name="service_itemsRemaining" id="service_itemsRemaining" size="40" value="<?php echo $this->_tpl_vars['serviceData']['service_itemsRemaining']; ?>
" />
								</div>
							</div>							
							<div class="row">
								<label>Payment Date</label>
								<div class="right"><input type="text" class="datepicker" name="service_paymentDate" id="service_paymentDate" placeholder="yyyy-mm-dd"  value="<?php echo $this->_tpl_vars['serviceData']['service_paymentDate']; ?>
" /></div>
							</div>							
								<div class="section">
									<div class="box">
										<div class="title">
											Description
											<span class="hide"></span>
										</div>
										<div class="content nopadding">
											<form action="">
													<textarea rows="" name="service_description" id="service_description"  cols="" class="wysiwyg" style="height : 500px;"><?php echo $this->_tpl_vars['serviceData']['service_description']; ?>
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