<?php /* Smarty version 2.6.20, created on 2013-11-08 17:48:53
         compiled from templates/invoice/invoice.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'default', 'templates/invoice/invoice.html', 27, false),array('modifier', 'date_format', 'templates/invoice/invoice.html', 38, false),)), $this); ?>
<!DOCTYPE html>
<!-- saved from url=(0047)http://css-tricks.com/examples/EditableInvoice/ -->
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta charset="UTF-8">
	<link rel="stylesheet" href="http://willow-nettica.co.za/templates/invoice/invoice_files/style.css">
	<link rel="stylesheet" href="http://willow-nettica.co.za/templates/invoice/invoice_files/print.css" media="print">
	<link rel='stylesheet'  href="http://willow-nettica.co.za/css/fonts_only.css" type='text/css' />
</head>
<body>
	<div id="page-wrap">
		<p id="header">INVOICE</p>
		<div id="identity">
            <p id="address">
				No. 64, Sir Lowry Road,<br />
				Zonnebloem, Cape Town<br />
				7925 <br />
				Tel: 0735640764				
			</p>
            <div class="logo">
              <img src="http://www.willow-nettica.co.za/img/ct_logo.jpg" />
            </div>
		</div>
		<div style="clear:both"></div>
		<div id="identity">
            <p id="address" style="width: 400px !important;"> 
				<span id="customer-title"><?php echo $this->_tpl_vars['client']['client_company']; ?>
</span><br /><br />
				Cell: <?php echo ((is_array($_tmp=@$this->_tpl_vars['client']['client_contact_cell'])) ? $this->_run_mod_handler('default', true, $_tmp, "N/A") : smarty_modifier_default($_tmp, "N/A")); ?>
 / Tel: <?php echo ((is_array($_tmp=@$this->_tpl_vars['client']['client_contact_telephone'])) ? $this->_run_mod_handler('default', true, $_tmp, "N/A") : smarty_modifier_default($_tmp, "N/A")); ?>
<br />
				Email: <?php echo ((is_array($_tmp=@$this->_tpl_vars['client']['client_contact_email'])) ? $this->_run_mod_handler('default', true, $_tmp, "N/A") : smarty_modifier_default($_tmp, "N/A")); ?>
<br />
			</p>
            <div class="logo"> 
				<table width="320px">
						<tr>
							<td class="meta-head">Invoice #</td>
							<td><?php echo $this->_tpl_vars['invoice']['invoice_reference']; ?>
</td>
						</tr>
						<tr>
							<td class="meta-head">Due Date</td>
							<td><p id="date"><?php echo ((is_array($_tmp=$this->_tpl_vars['paymentDate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%B %e, %Y") : smarty_modifier_date_format($_tmp, "%B %e, %Y")); ?>
</p></td>
						</tr>
						<tr>
							<td class="meta-head">Amount Due</td>
							<td><div class="due">R <?php echo $this->_tpl_vars['invoice']['invoice_total']; ?>
</div></td>
						</tr>
				</table>              
            </div>
		</div>
		<table id="items">
			<tr>
				<th>Item</th>
				<th>Description</th>
				<th width="17%">Price</th>
			</tr>
			<?php $_from = $this->_tpl_vars['products']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
			<tr class="item-row">
				<td class="item-name"><?php echo $this->_tpl_vars['item']['invoiceitem_name']; ?>
</td>
				<td class="description"><?php echo $this->_tpl_vars['item']['invoiceitem_description']; ?>
</td>
				<td align="right">R <?php echo $this->_tpl_vars['item']['invoiceitem_price']; ?>
</td>
			</tr>
			<?php endforeach; endif; unset($_from); ?>
			<tr>
				<td colspan="3" align="right" class="total-value"><div id="total">R <?php echo $this->_tpl_vars['invoice']['invoice_total']; ?>
</div></td>
			</tr>
		</table>
		<div id="terms">
		  <p id="header">Payments Made To: </p>
		  Account Holder: Willow-Nettica Pty Ltd<br />
		  Bank: Standard Bank<br />
		  Account Number: 070595658<br />
		  Branch Code: 020909<br />
		  <b>Reference: <?php echo $this->_tpl_vars['invoice']['invoice_reference']; ?>
</b>
		</div>
	</div>
</body>
</html>