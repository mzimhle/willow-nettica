<?php /* Smarty version 2.6.20, created on 2013-11-04 09:23:05
         compiled from admin/products/clientproducts/details.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'admin/products/clientproducts/details.tpl', 49, false),array('function', 'html_options', 'admin/products/clientproducts/details.tpl', 53, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8" /> 
	<title>Admin | Products | Client Products </title>
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
					<li><a href="/admin/products/">Products</a></li>
					<li><a href="/admin/products/clientproducts/">Client Products</a></li>
					<li><a href="#"><?php if (isset ( $this->_tpl_vars['clientData'] )): ?><?php echo $this->_tpl_vars['clientData']['client_company']; ?>
<?php else: ?>Add New Client<?php endif; ?></a></li>
				</ul>
			</div>
			<div class="section">
				<div class="box">
					<div class="title">
						<?php if (isset ( $this->_tpl_vars['clientData'] )): ?><?php echo $this->_tpl_vars['clientData']['client_company']; ?>
<?php else: ?>Add New Client<?php endif; ?>
						<span class="hide"></span>
					</div>
					<div class="content">
						<form name="detailsForm" id="detailsForm" action="/admin/products/clientproducts/details.php?reference=<?php echo $this->_tpl_vars['clientData']['client_reference']; ?>
" method="post">
						<table cellspacing="0" cellpadding="0" border="0"> 
							<thead> 
								<tr>
									<th>Added</th>
									<th>Product Name</th>
									<th>Status</th>
									<th></th>
								</tr>
							</thead>
							<tbody>
							  <?php $_from = $this->_tpl_vars['clientProductData']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
							  <tr>
								<td align="left" class="alt"><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['clientproduct_added'])) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)); ?>
</td>		
								<td align="left" class="alt">
									<select id="fk_product_reference_<?php echo $this->_tpl_vars['item']['pk_clientproduct_id']; ?>
" name="fk_product_reference_<?php echo $this->_tpl_vars['item']['pk_clientproduct_id']; ?>
">
										<option value=""> ---- </option>
										<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['productPairs'],'selected' => $this->_tpl_vars['item']['fk_product_reference']), $this);?>

									</select>							
								</td>	
								<td align="left" class="alt">
									<select id="clientproduct_active_<?php echo $this->_tpl_vars['item']['pk_clientproduct_id']; ?>
" name="clientproduct_active_<?php echo $this->_tpl_vars['item']['pk_clientproduct_id']; ?>
">
										<option value="1" <?php if ($this->_tpl_vars['item']['clientproduct_active'] == 1): ?> SELECTED <?php endif; ?>>Active</option>
										<option value="0" <?php if ($this->_tpl_vars['item']['clientproduct_active'] == 0): ?> SELECTED <?php endif; ?>>Not Active</option>
									</select> 
								</td>								
								<td align="left" class="alt">
									<button type="button" class="link link_<?php echo $this->_tpl_vars['item']['pk_clientproduct_id']; ?>
" onclick="updateForm(<?php echo $this->_tpl_vars['item']['pk_clientproduct_id']; ?>
); return false;"><span>Update</span></button>	
								</td>		
							  </tr>
							  <?php endforeach; endif; unset($_from); ?>  
							  <tr>
								<td align="left" class="alt"><?php echo ((is_array($_tmp=time())) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)); ?>
</td>		
								<td align="left" class="alt">
									<select id="fk_product_reference" name="fk_product_reference">
										<option value=""> ---- </option>
										<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['productPairs'],'selected' => $this->_tpl_vars['clientProductData']['fk_product_reference']), $this);?>

									</select>
								</td>							
								<td align="left" class="alt" >
									<select id="clientproduct_active" name="clientproduct_active">
										<option value="1">Active</option>
										<option value="0">Not Active</option>
									</select> 
								</td>		
								<td align="left" class="alt">
									<button type="submit" onclick="submitForm()"><span>Add</span></button>
								</td>										
							  </tr>								  
							</tbody>
						</table>
							
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
		
		function updateForm(id) {					
			$(\'.link_\'+id).html(\'<b>Loading...</b>\');

				$.ajax({
						type: "GET",
						url: "html.php",
						data: "clientproductid="+id+"&fk_product_reference="+$(\'#fk_product_reference_\'+id+ \' :selected\').val()+"&fk_client_reference='; ?>
<?php echo $this->_tpl_vars['clientData']['client_reference']; ?>
<?php echo '&clientproduct_active="+$(\'#clientproduct_active_\'+id+ \' :selected\').val(),
						dataType: "json",
						success: function(data){
								if(data.result == 1) {
									alert(\'Updated\');
									window.location.href = window.location.href;
								} else {
									alert(data.message);
								}
						}
				});	
				
				$(\'.link_\'+id).html(\'Update Skill\');
		}				
		</script>
		'; ?>
				
	</div>
</div>
</body>
</html> 