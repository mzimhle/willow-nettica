<?php /* Smarty version 2.6.20, created on 2014-04-22 09:17:18
         compiled from admin/login.tpl */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8" /> 
	<title>Admin | Login</title>
	<meta name="apple-mobile-web-app-capable" content="no" />
	<meta name="apple-mobile-web-app-status-bar-style" content="black" />
	<meta name="viewport" content="width=device-width,initial-scale=0.69,user-scalable=yes,maximum-scale=1.00" />
	<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'admin/includes/css.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

	<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'admin/includes/javascript.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

</head>
<body>
	<div id="wrapper" class="login">
		<div class="box">
			<div class="title">
				Please login
				<span class="hide"></span>
			</div>
			<div class="content">
				<?php if (isset ( $this->_tpl_vars['message'] )): ?>
				<div class="message inner red">
					<span><b>Error</b>: <?php echo $this->_tpl_vars['message']; ?>
</span>
				</div>
				<?php else: ?>
				<div class="message inner blue">
					<span><b>Information</b>: Please login below to proceed.</span>
				</div>			
				<?php endif; ?>
				<form id="loginForm" name="loginForm" method="post" target="" action="login.php">
					<div class="row">
						<label>Username</label>
						<div class="right"><input name="username" type="text" id="username" maxlength="100" value="" /></div>
					</div>
					<div class="row">
						<label>Password</label>
						<div class="right"><input name="password" type="password" id="password" value="" />	</div>
					</div>
					<div class="row">
						<div class="right">
							<button type="submit"><span>Submit</span></button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</body>
</html> 