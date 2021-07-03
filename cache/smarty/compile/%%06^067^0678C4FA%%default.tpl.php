<?php /* Smarty version 2.6.20, created on 2014-04-22 09:17:43
         compiled from admin/invoices/default.tpl */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8" /> 
	<title>Dashbaord | Invoices</title>
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
					<li><a href="/admin/invoices/">Invoices</a></li>	
				</ul>
			</div>
			<div class="btn-box">
				<div class="content">
					<a href="/admin/invoices/paid/" class="item">
						<img src="/admin/images/gfx/icons/big/messages.png" alt="Paid Invoices" />
						<span>Paid</span>
						View Paid Invoices
					</a>
					<a href="/admin/invoices/unpaid/" class="item">
						<img src="/admin/images/gfx/icons/big/web.png" alt="Unpaid Invoices" />
						<span>Unpaid</span>
						View Unpaid Invoices
					</a>
					<a href="/admin/invoices/create/" class="item">
						<img src="/admin/images/gfx/icons/big/support.png" alt="Create Invoice" />
						<span>Create</span>
						Create onceoff invoice
					</a>				
				</div>
			</div>
			<div class="btn-box">
				<div class="content">
					<a href="/admin/invoices/monthlyinvoices/" class="item">
						<img src="/admin/images/gfx/icons/big/support.png" alt="Monthly Sent Invoices" />
						<span>Monthly Invoices</span>
						Monthly sent invoices
					</a>					
				</div>			
			</div>
		</div>
		<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'admin/includes/footer.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

	</div>
</div>
</body>
</html> 