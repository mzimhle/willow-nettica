<?php /* Smarty version 2.6.20, created on 2013-11-06 17:08:37
         compiled from admin/invoices/unpaid/details.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'admin/invoices/unpaid/details.tpl', 65, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8" /> 
	<title>Admin | Invoices | Unpaid | <?php echo $this->_tpl_vars['invoiceData']['client_company']; ?>
 - <?php echo $this->_tpl_vars['invoiceData']['invoice_reference']; ?>
</title>
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
					<li><a href="/admin/invoices/">Invoinces</a></li>
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
						<form id="detailsForm" name="detailsForm" action="/admin/invoices/unpaid/details.php?reference=<?php echo $this->_tpl_vars['invoiceData']['invoice_reference']; ?>
" method="post" enctype="multipart/form-data">
							<?php if (isset ( $this->_tpl_vars['errorMessages'] )): ?>
							<div class="row">
								<label>Errors:</label>
								<div class="right">
									<span><?php echo $this->_tpl_vars['errorMessages']; ?>
</span>
								</div>
							</div>
							<?php endif; ?>							
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
								<span><?php echo ((is_array($_tmp=$this->_tpl_vars['invoiceData']['invoice_payment_date'])) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)); ?>
</span>
								</div>
							</div>	
							<div class="row">
								<label></label>
								<div class="right">
									<input type="checkbox" name="invoice_resend" id="invoice_resend" value="1" />
									<label for="invoice_resend">Send Invoice</label>
									
									<input type="checkbox" name="invoice_paid" id="invoice_paid" value="1" <?php if ($this->_tpl_vars['invoiceData']['invoice_paid'] == 1): ?>CHECKED<?php endif; ?> />
									<label for="invoice_paid">Invoice Paid</label>
								
									<input type="checkbox" name="invoice_deleted" id="invoice_deleted" value="1" <?php if ($this->_tpl_vars['invoiceData']['invoice_deleted'] == 1): ?>CHECKED<?php endif; ?> />
									<label for="invoice_deleted">Delete Invoice</label>									
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
							<div class="row">
							<table cellspacing="0" cellpadding="0" border="0"> 
								<thead> 
									<tr>
										<th>File Added</th>
										<th>File Description</th>
										<th></th>
										<th></th>
									</tr>
								</thead>
								<tbody>
								  <?php $_from = $this->_tpl_vars['invoicefileData']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
								  <tr>	
									<td align="left" class="alt"><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['invoiceFile_added'])) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)); ?>
</td>
									<td align="left" class="alt"><?php echo $this->_tpl_vars['item']['invoiceFile_description']; ?>
</td>
									<td align="left" class="alt"><a href="<?php echo $this->_tpl_vars['item']['invoiceFile_path']; ?>
" target="_blank"><?php echo $this->_tpl_vars['item']['invoiceFile_filename']; ?>
</a></td>
									<td align="left" class="alt"><a href="javascript:void(0)" onclick="deletefile('<?php echo $this->_tpl_vars['item']['invoiceFile_filename']; ?>
');">delete</a></td>
								  </tr>
								  <?php endforeach; else: ?>
								  <tr><td colspan="5">No records found</td></tr>
								  <?php endif; unset($_from); ?>   
									<tr>
										<td><?php echo ((is_array($_tmp=time())) ? $this->_run_mod_handler('date_format', true, $_tmp, '%Y-%m-%d %H:%M:%S') : smarty_modifier_date_format($_tmp, '%Y-%m-%d %H:%M:%S')); ?>
</td>
										<td colspan="4"><input type="text" class="custom" id="invoiceFile_description" size="85" name="invoiceFile_description" value="" /></td>										
									</tr>
									<tr><td colspan="5"><div class="right">Upload File: <input type="file" id="invoiceFile" name="invoiceFile" /></div></td></tr>
								</tbody>
							</table>							
							</div>																					
								<div class="section">
									<div class="box">
										<div class="title">
											Notes:
											<span class="hide"></span>
										</div>
										<div class="content nopadding">
												<textarea rows="" name="invoice_notes" id="invoice_notes"  cols="" class="wysiwyg" style="height : 300px;"><?php echo $this->_tpl_vars['invoiceData']['invoice_notes']; ?>
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
				if(confirm(\'Are you sure you want to continue? Please check if you are not deleting the invoice by mistake.\') == true) {
					document.forms.detailsForm.submit();					 
				}
			}
			
			function deletefile(filename) {		
				if(confirm(\'Are you sure you want to delete this file?\') == true) {
					$.ajax({
							type: "GET",
							url: "details.php?reference='; ?>
<?php echo $this->_tpl_vars['invoiceData']['invoice_reference']; ?>
<?php echo '&delete=1",
							data: "filename="+filename,
							dataType: "json",
							success: function(data){
									if(data.result == 1) {
										alert(\'Deleted\');
										window.location.href = window.location.href;
									} else {
										alert(data.message);
									}
							}
					});		
				}				
			}
		</script>
		'; ?>
				
	</div>
</div>
</body>
</html> 