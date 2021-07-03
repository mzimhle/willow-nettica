<?php /* Smarty version 2.6.20, created on 2013-08-15 23:10:31
         compiled from mailers/enquiry.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'mailers/enquiry.html', 26, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
</head>

<body style="margin:0; padding: 0;color: #3F3F3F;font-size: 12px;">
<p><br />
<table cellpadding="0" cellspacing="0" border="0" align="center" width="650" style="font-family: Verdana, Geneva, Arial, helvetica, sans-serif; color: #3F3F3F;font-size: 12px;;">
  <tr>
  	<td colspan="2" style="border-bottom: 1px solid #e1e1e7;">&nbsp;</td>
  </tr>
	<tr>
		<td height="30" colspan="2" style="color: #705B35;font-size: 15px;padding-bottom: 13px;"><strong><h2>Online Enquiry Confirmation</h2></strong></td>
	</tr>
	<tr>
		<td height="30" colspan="2" align="center">
			<strong>Thank you for your enquiry <?php echo $this->_tpl_vars['enquiryData']['enquiry_name']; ?>
, we will get back to you as soon as possible. Below was your enquiry:</strong>
		</td>
	</tr>
	<tr>
  	<td colspan="2" style="border-bottom: 1px solid #e1e1e7;">&nbsp;</td>
  </tr>	
	<tr>
		<td height="30"><strong>Date Sent:</strong></td>
		<td><p><?php echo ((is_array($_tmp=time())) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)); ?>
</p></td>
	</tr>
	<tr>
		<td height="30"><strong>Enquiry Reference:</strong></td>
		<td><?php echo $this->_tpl_vars['enquiryData']['enquiry_reference']; ?>
</td>
	</tr>	
	<tr>
		<td height="30"><strong>Name:</strong></td>
		<td><?php echo $this->_tpl_vars['enquiryData']['enquiry_name']; ?>
</td>
	</tr>
	<tr>
		<td height="30"><strong>Email Address:</strong></td>
		<td><?php echo $this->_tpl_vars['enquiryData']['enquiry_email']; ?>
</td>
	</tr>		
	<tr>
		<td height="30"><strong>Number:</strong></td>
		<td><?php echo $this->_tpl_vars['enquiryData']['enquiry_number']; ?>
</td>
	</tr>	
	<tr>
		<td height="30"><strong>Area / Town:</strong></td>
		<td><?php echo $this->_tpl_vars['enquiryData']['areaMap_shortPath']; ?>
</td>
	</tr>	
	<tr>
		<td height="30"><strong>Message:</strong></td>
		<td><?php echo $this->_tpl_vars['enquiryData']['enquiry_comments']; ?>
</td>
	</tr>		
  <tr>
  	<td colspan="2" style="border-bottom: 1px solid #e1e1e7;">&nbsp;</td>
  </tr>	
    <tr>
  	<td colspan="2" height="20">&nbsp;</td>
  </tr>		
      <tr>
  	<td colspan="2" height="20" style="border-bottom: 1px solid #e1e1e7;">&nbsp;</td>
  </tr>	
</table>
</body>
</html>