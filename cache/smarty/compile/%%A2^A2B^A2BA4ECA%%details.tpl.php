<?php /* Smarty version 2.6.20, created on 2013-11-11 21:13:38
         compiled from admin/products/items/details.tpl */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8" /> 
	<title>Admin | Products | Items</title>
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
					<li><a href="/admin/products/">Clients</a></li>
					<li><a href="/admin/products/items/">Product items</a></li>
					<li><a href="#"><?php if (isset ( $this->_tpl_vars['productData'] )): ?><?php echo $this->_tpl_vars['productData']['product_name']; ?>
<?php else: ?>Add New Product Item<?php endif; ?></a></li>
				</ul>
			</div>
			<div class="section">
				<div class="box">
					<div class="title">
						<?php if (isset ( $this->_tpl_vars['productData'] )): ?><?php echo $this->_tpl_vars['productData']['product_name']; ?>
<?php else: ?>Add New Product Item<?php endif; ?>
						<span class="hide"></span>
					</div>
					<div class="content">
						<form id="detailsForm" name="detailsForm" action="/admin/products/items/details.php<?php if (isset ( $this->_tpl_vars['productData'] )): ?>?reference=<?php echo $this->_tpl_vars['productData']['product_reference']; ?>
<?php endif; ?>" method="post">
							<div class="row">
								<label>Status</label>
								<div class="right">
								<div class="custom-radio"><input type="radio" <?php if (isset ( $this->_tpl_vars['productData'] ) && $this->_tpl_vars['productData']['product_active'] == 1): ?>checked="checked"<?php endif; ?> id="product_active" value="1" name="statusbutton"><label for="product_active" class="checked">Active</label></div> 
								<div class="custom-radio"><input type="radio" <?php if (isset ( $this->_tpl_vars['productData'] ) && $this->_tpl_vars['productData']['product_active'] == 0): ?>checked="checked"<?php endif; ?> id="product_non_active" value="2" name="statusbutton"><label for="product_non_active" class="">Non Active</label></div> 
								<div class="custom-radio"><input type="radio"  <?php if (isset ( $this->_tpl_vars['productData'] ) && $this->_tpl_vars['productData']['product_deleted'] == 1): ?>checked="checked"<?php endif; ?> id="product_deleted" value="3" name="statusbutton"><label for="product_deleted" class="">Delete</label></div> 
								</div>
							</div>							
							<div class="row">
								<label>Name</label>
								<div class="right">
								<input type="text" name="product_name" id="product_name" size="40" value="<?php echo $this->_tpl_vars['productData']['product_name']; ?>
"/>
								</div>
							</div>
							<div class="row">
								<label>Price</label>
								<div class="right">
									<input type="text" name="product_price" id="product_price" size="40" value="<?php echo $this->_tpl_vars['productData']['product_price']; ?>
"/>
								</div>
							</div>
							<div class="row">
								<label>Payment Type</label>
								<div class="right">
								<select name="product_payment_type" id="product_payment_type">
									<option value="onceoff" <?php if ($this->_tpl_vars['productData']['product_payment_type'] == 'onceoff'): ?> SELECTED<?php endif; ?>>Once Off</option>
									<option value="month" <?php if ($this->_tpl_vars['productData']['product_payment_type'] == 'month'): ?> SELECTED<?php endif; ?>>Monthly</option>
									<option value="year" <?php if ($this->_tpl_vars['productData']['product_payment_type'] == 'year'): ?> SELECTED<?php endif; ?>>Yearly</option>
								</select>
								</div>
							</div>	
							<div class="row">
								<label>Description</label>
								<div class="right">
									<textarea rows="3" cols="30" id="product_description" name="product_description" class="custom"><?php echo $this->_tpl_vars['productData']['product_description']; ?>
</textarea>
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