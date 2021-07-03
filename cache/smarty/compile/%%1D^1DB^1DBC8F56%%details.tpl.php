<?php /* Smarty version 2.6.20, created on 2013-08-26 09:24:48
         compiled from admin/newsletters/subscribers/details.tpl */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8" /> 
	<title>Admin | Newsletter Subscribers </title>
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
					<li><a href="/admin/newsletters/">Newsletters</a></li>
					<li><a href="/admin/newsletters/subscribers/">Subscribers</a></li>
					<li><a href="#"><?php if (isset ( $this->_tpl_vars['subscriberData'] )): ?><?php echo $this->_tpl_vars['subscriberData']['subscriber_name']; ?>
 <?php echo $this->_tpl_vars['subscriberData']['subscriber_surname']; ?>
<?php else: ?>Add New Subscriber<?php endif; ?></a></li>
				</ul>
			</div>
			<div class="section">
				<div class="box">
					<div class="title">
						<?php if (isset ( $this->_tpl_vars['subscriberData'] )): ?><?php echo $this->_tpl_vars['subscriberData']['subscriber_name']; ?>
 <?php echo $this->_tpl_vars['subscriberData']['subscriber_surname']; ?>
<?php else: ?>Add New Subscriber<?php endif; ?>
						<span class="hide"></span>
					</div>
					<div class="content">
						<form id="detailsForm" name="detailsForm" action="/admin/newsletters/subscribers/details.php<?php if (isset ( $this->_tpl_vars['subscriberData'] )): ?>?code=<?php echo $this->_tpl_vars['subscriberData']['subscriber_code']; ?>
<?php endif; ?>" method="post"  class="valid" novalidate="novalidate">
							<div class="row">
								<label>Status</label>
								<div class="right">
								<div class="custom-radio"><input type="radio" <?php if (isset ( $this->_tpl_vars['subscriberData'] ) && $this->_tpl_vars['subscriberData']['subscriber_active'] == 1): ?>checked="checked"<?php endif; ?> id="subscriber_active" value="1" name="statusbutton"><label for="subscriber_active" class="checked">Subscribed</label></div> 
								<div class="custom-radio"><input type="radio" <?php if (isset ( $this->_tpl_vars['subscriberData'] ) && $this->_tpl_vars['subscriberData']['subscriber_active'] == 0): ?>checked="checked"<?php endif; ?> id="subscriber_non_active" value="2" name="statusbutton"><label for="subscriber_non_active" class="">Unsubscribed</label></div> 
								<div class="custom-radio"><input type="radio"  <?php if (isset ( $this->_tpl_vars['subscriberData'] ) && $this->_tpl_vars['subscriberData']['subscriber_deleted'] == 1): ?>checked="checked"<?php endif; ?> id="subscriber_deleted" value="3" name="statusbutton"><label for="subscriber_deleted" class="">Delete</label></div> 
								</div>
							</div>						
							<div class="row">
								<label>Name</label>
								<div class="right">
								<input type="text" name="subscriber_name" id="subscriber_name" size="40" value="<?php echo $this->_tpl_vars['subscriberData']['subscriber_name']; ?>
" <?php echo 'class="{validate:{required:true, messages:{required:\'Please enter company\'}}}"'; ?>
  />
								</div>
							</div>
							<div class="row">
								<label>Surname</label>
								<div class="right">
									<input type="text" name="subscriber_surname" id="subscriber_surname" size="40" value="<?php echo $this->_tpl_vars['subscriberData']['subscriber_surname']; ?>
"  <?php echo 'class="{validate:{required:true, messages:{required:\'Please enter a name\'}}}"'; ?>
 />
								</div>
							</div>
							<div class="row">
								<label>Email</label>
								<div class="right">
							<input type="text" name="subscriber_email" id="subscriber_email" size="40" value="<?php echo $this->_tpl_vars['subscriberData']['subscriber_email']; ?>
"  <?php echo 'class="{validate:{required:true, messages:{required:\'Please enter surname\'}}}"'; ?>
 />
								</div>
							</div>	
							<div class="row">
								<label>Cell</label>
								<div class="right">
							<input type="text" name="subscriber_cell" id="subscriber_cell" size="40" value="<?php echo $this->_tpl_vars['subscriberData']['subscriber_cell']; ?>
"  <?php echo 'class="{validate:{required:true, messages:{required:\'Please enter position\'}}}"'; ?>
 />
								</div>
							</div>
							<div class="row">
								<label></label>
								<div class="right">
									<button type="submit"><span>Sumbit</span></button>							
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