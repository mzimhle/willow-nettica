<?php /* Smarty version 2.6.20, created on 2013-07-03 02:04:19
         compiled from admin/products/invoices/invoice.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_options', 'admin/products/invoices/invoice.tpl', 41, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8" /> 
	<title>Admin | Products | Invoices | Create Invoice</title>
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
					<li><a href="#">Create an invoice</a></li>
				</ul>
			</div>
			<div class="section">
				<div class="box">
					<div class="title">
						Create an invoice
						<span class="hide"></span>
					</div>
					<div class="content">
						<form name="invoiceForm" id="invoiceForm" action="/admin/products/invoices/invoice.php" method="post">
							<div class="row">
								<label>Client</label>
								<div class="right">
									<select id="fk_client_reference" name="fk_client_reference">
										<option value=""> ---- </option>
										<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['clientPairs'],'selected' => $this->_tpl_vars['accountData']['fk_client_reference']), $this);?>

									</select>	
								</div>
							</div>
							<div class="row">
								<label>Payable by</label>
								<div class="right">
									<input type="text" id="due_date" name="due_date"  placeholder="yyyy-mm-dd"  class="datepicker"  />
								</div>
							</div>
							<div class="row">
								<table cellspacing="0" cellpadding="0" border="0" class="sorting"> 
									<thead> 
										<tr>
											<th>Item</th>
											<th>Description</th>
											<th>Price</th>
											<th></th>
										</tr>
									</thead>
									<tbody>
									  <?php $_from = $this->_tpl_vars['invoiceitem']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['foo'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['foo']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['iteminv']):
        $this->_foreach['foo']['iteration']++;
?>
									  <tr>
										<td align="left" class="alt"><?php echo $this->_tpl_vars['iteminv']['invoiceitem_name']; ?>
</td>		
										<td align="left" class="alt"><?php echo $this->_tpl_vars['iteminv']['invoiceitem_description']; ?>
</td>	
										<td align="left" class="alt"><?php echo $this->_tpl_vars['iteminv']['invoiceitem_price']; ?>
</td>		
										<td align="left" class="alt"><a class="link" href="javascript:deleteItem(<?php echo ($this->_foreach['foo']['iteration']-1); ?>
);">Delete Item</a></td>	
									  </tr>
									  <?php endforeach; endif; unset($_from); ?>   								  
									</tbody>
								</table>							
							</div>	
							<input type="hidden" id="addItems" name="addItems" value="1" />
							</form>							
							<div class="row">
							<form name="itemsForm" id="itemsForm" action="/admin/products/invoices/invoice.php" method="post">
								<table cellspacing="0" cellpadding="0" border="0"> 
									<thead> 
										<tr>
											<th>Item</th>
											<th>Description</th>
											<th>Price</th>
										</tr>
									</thead>
									<tbody>
									  <tr>
										<td valign="top">
												<input type="text" id="invoice_item" class="custom" size="20" name="invoice_item" />
										</td>		
										<td valign="top">
											<textarea rows="4" cols="40" name="invoice_description" id="invoice_description" class="custom"><?php echo $this->_tpl_vars['invoiceData']['invoice_description']; ?>
</textarea>
										</td>							
										<td valign="top">
											<input type="text" name="invoice_price" size="5" id="invoice_price"  class="custom" />
										</td>	
									  </tr>									  
									</tbody>
								</table>
								<input type="hidden" id="updateItems" name="updateItems" value="1" />
							</form>														
							</div>
							<div class="row">
								<label></label>
								<div class="right">
									<button type="submit" onclick="itemsSubmitForm()"><span>Add Item</span></button>							
								</div>
							</div>							
							<div class="row">
								<label></label>
								<div class="right">
									<button type="submit" onclick="invoiceSubmitForm()"><span>Create Invoice</span></button>							
								</div>
							</div>
							<?php if (isset ( $this->_tpl_vars['error'] )): ?>
							<div class="row">
								<label></label>
								<div class="right">
									<span class="error"><?php echo $this->_tpl_vars['error']; ?>
</span>					
								</div>
							</div>
							<?php endif; ?>
						</form>
					</div>
				</div>
			</div>
		</div>
		<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'admin/includes/footer.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

		<?php echo '
		<script type="text/javascript">
				
				function invoiceSubmitForm() {
					document.forms.invoiceForm.submit();					 
				}
				
				function itemsSubmitForm() {
					document.forms.itemsForm.submit();					 
				}
				
				function deleteItem(id) {					
					$.ajax({
							type: "GET",
							url: "html.php",
							data: "delete=1&deleteitem="+id,
							dataType: "json",
							success: function(data){
									if(data.result == 1) {
										alert(\'Item Removed\');
										window.location.href = window.location.href;
									} else {
										alert(data.message);
									}
							}
					});	
				}		
		</script>
		'; ?>
				
	</div>
</div>
</body>
</html> 