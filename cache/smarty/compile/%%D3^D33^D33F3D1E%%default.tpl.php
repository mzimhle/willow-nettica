<?php /* Smarty version 2.6.20, created on 2013-10-19 15:40:13
         compiled from admin/archive/scrape/default.tpl */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8" /> 
	<title>Admin | Archive | Scrape</title>
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
					<li><a href="/admin/archive/">Archive</a></li>
					<li><a href="/admin/archive/scrape/">Scrape</a></li>
				</ul>
			</div>
			<div class="btn-box">
				<div class="content">
					<div class="section">
						<div class="box">
							<div class="title">
								Scrape
								<span class="hide"></span>
							</div>
							<div class="content">
								<table cellspacing="0" cellpadding="0" border="0" class="all"> 
									<thead> 
										<tr>
											<th>Type</th>
											<th>Referer</th>
											<th>Name</th>
											<th>Email</th>
											<th>Fax</th>
											<th>Number</th>
											<th>Link</th>
										</tr>
									</thead>
									<tbody>
									  <?php $_from = $this->_tpl_vars['spamData']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
									  <tr>
										<td align="left" class="alt"><?php echo $this->_tpl_vars['item']['spamType_name']; ?>
</td>	
										<td align="left" class="alt"><a href="<?php echo $this->_tpl_vars['item']['spam_referer']; ?>
" target="_blank">Referer Link</a></td>	
										<td align="left" class="alt"><a href="/admin/archive/scrape/details.php?spamid=<?php echo $this->_tpl_vars['item']['pk_spam_id']; ?>
"><?php echo $this->_tpl_vars['item']['spam_name']; ?>
</a></td>	
										<td align="left" class="alt"><?php echo $this->_tpl_vars['item']['spam_email']; ?>
</td>	
										<td align="left" class="alt"><?php echo $this->_tpl_vars['item']['spam_fax']; ?>
</td>	
										<td align="left" class="alt"><?php echo $this->_tpl_vars['item']['spam_number']; ?>
</td>	
										<td align="left" class="alt"><?php if ($this->_tpl_vars['item']['spam_link'] == ''): ?>N/A<?php else: ?><a href="<?php echo $this->_tpl_vars['item']['spam_link']; ?>
" target="_blank">Spam Link</a><?php endif; ?></td>	
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