<?php /* Smarty version 2.6.20, created on 2013-10-19 15:37:17
         compiled from admin/invoices/paid/details.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'admin/invoices/paid/details.tpl', 58, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8" /> 
	<title>Admin | Invoices | Paid | <?php echo $this->_tpl_vars['invoiceData']['client_company']; ?>
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
					<li><a href="/admin/invoices/paid/">Paid Invoinces</a></li>
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
								<span><?php echo ((is_array($_tmp=$this->_tpl_vars['invoiceData']['invoice_payment_date'])) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)); ?>
</span>
								</div>
							</div>	
							<div class="row">
								<label>Payment Date</label>
								<div class="right">
								<span><?php echo ((is_array($_tmp=$this->_tpl_vars['invoiceData']['invoice_paid_date'])) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)); ?>
</span>
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
								  </tr>
								  <?php endforeach; else: ?>
								  <tr><td colspan="3">No records found</td></tr>
								  <?php endif; unset($_from); ?>   
								</tbody>
							</table>							
							</div>							
								<div class="section">
									<div class="box">
										<div class="title">
											Notes
											<span class="hide"></span>
										</div>
										<div class="content">
												<?php echo $this->_tpl_vars['invoiceData']['invoice_notes']; ?>

										</div>
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