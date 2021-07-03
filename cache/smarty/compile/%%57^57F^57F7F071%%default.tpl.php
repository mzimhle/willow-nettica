<?php /* Smarty version 2.6.20, created on 2014-04-22 09:17:34
         compiled from admin/enquiries/default.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'admin/enquiries/default.tpl', 50, false),array('modifier', 'default', 'admin/enquiries/default.tpl', 53, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8" /> 
	<title>Admin | Enquiries</title>
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
					<li><a href="/admin/enquiries/">Enquiries</a></li>
				</ul>
			</div>
			<div class="btn-box">
				<div class="content">
			<div class="section">
				<div class="box">
					<div class="title">
						Enquiries
						<span class="hide"></span>
					</div>
					<div class="content">
						<table cellspacing="0" cellpadding="0" border="0" class="all"> 
							<thead> 
								<tr>
									<th>Reference</th>
									<th>Added</th>
									<th>Full Name</th>
									<th>Email</th>
									<th>Number(s)</th>				
								</tr>
							</thead>
							<tbody>
								  <?php $_from = $this->_tpl_vars['enquiryItems']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
								  <tr>
									<td><b><?php echo $this->_tpl_vars['item']['enquiry_reference']; ?>
</b></td>	
									<td><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['enquiry_added'])) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)); ?>
</td>		
									<td><a href="/admin/enquiries/details.php?enquiryid=<?php echo $this->_tpl_vars['item']['enquiry_reference']; ?>
"><?php echo $this->_tpl_vars['item']['enquiry_name']; ?>
</a></td>	
									<td><?php echo $this->_tpl_vars['item']['enquiry_email']; ?>
</td>
									<td><?php echo ((is_array($_tmp=@$this->_tpl_vars['item']['enquiry_number'])) ? $this->_run_mod_handler('default', true, $_tmp, "N/A") : smarty_modifier_default($_tmp, "N/A")); ?>
</td>
								  </tr>
								  <?php endforeach; endif; unset($_from); ?>   
							</tbody>
						</table>
					</div>
				</div>
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