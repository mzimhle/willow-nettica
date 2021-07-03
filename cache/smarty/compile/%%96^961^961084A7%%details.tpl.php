<?php /* Smarty version 2.6.20, created on 2013-07-03 16:32:34
         compiled from admin/invoices/details.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'admin/invoices/details.tpl', 57, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8" /> 
	<title>Admin | Invoices | Details</title>
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
					<li><a href="/admin/invoinces/">Invoinces</a></li>
					<li><a href="#"><?php echo $this->_tpl_vars['invoiceData']['client_company']; ?>
 - <?php echo $this->_tpl_vars['invoiceData']['invoice_reference']; ?>
</a></li>
				</ul>
			</div>
			<div class="section">
				<div class="box">
					<div class="title">
						Invoince Details
						<span class="hide"></span>
					</div>
					<div class="content">
						<form id="detailsForm" name="detailsForm" action="/admin/invoices/details.php?reference=<?php echo $this->_tpl_vars['invoiceData']['invoice_reference']; ?>
" method="post">
							<div class="row">
								<label>Reference</label>
								<div class="right">
									<span><?php echo $this->_tpl_vars['invoiceData']['invoice_reference']; ?>
</span>
								</div>
							</div>
							<div class="row">
								<label>Client</label>
								<div class="right">
									<span><?php echo $this->_tpl_vars['invoiceData']['client_company']; ?>
</span>
								</div>
							</div>
							<div class="row">
								<label>Invoice Total: </label>
								<div class="right">
									<span><?php echo $this->_tpl_vars['invoiceData']['invoice_total']; ?>
</span>
								</div>
							</div>							
							<div class="row">
								<label>Due Date</label>
								<div class="right">
								<span><?php echo ((is_array($_tmp=$this->_tpl_vars['invoiceData']['client_payment_date'])) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)); ?>
</span>
								</div>
							</div>	
							<div class="row">
								<label></label>
								<div class="right">
									<input type="checkbox" name="invoice_resend" id="invoice_resend" value="1" />
									<label for="invoice_resend">Resend Invoice</label>
									
									<input type="checkbox" name="invoice_paid" id="invoice_paid" value="1" <?php if ($this->_tpl_vars['invoiceData']['invoice_paid'] == 1): ?>CHECKED<?php endif; ?> />
									<label for="invoice_paid">Invoice Paid ?</label>
								</div>
							</div>
							<div class="row">
							<table cellspacing="0" cellpadding="0" border="0"> 
								<thead> 
									<tr>
										<th>Name</th>
										<th>Description</th>
										<th>Price</th>
									</tr>
								</thead>
								<tbody>
								  <?php $_from = $this->_tpl_vars['invoiceitemData']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
								  <tr>	
									<td align="left" class="alt"><?php echo $this->_tpl_vars['item']['invoiceitem_name']; ?>
</td>
									<td align="left" class="alt"><?php echo $this->_tpl_vars['item']['invoiceitem_description']; ?>
</td>
									<td align="left" class="alt"><?php echo $this->_tpl_vars['item']['invoiceitem_price']; ?>
</td>
								  </tr>
								  <?php endforeach; endif; unset($_from); ?>    
								</tbody>
							</table>	
							</div>							
								<div class="section">
									<div class="box">
										<div class="title">
											More - e.g. bank statements, etc.
											<span class="hide"></span>
										</div>
										<div class="content nopadding">
												<textarea rows="" name="invoice_more" id="invoice_more"  cols="" class="wysiwyg" style="height : 300px;"><?php echo $this->_tpl_vars['invoiceData']['invoice_more']; ?>
</textarea>
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