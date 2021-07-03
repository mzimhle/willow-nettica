<?php /* Smarty version 2.6.20, created on 2013-10-08 18:04:45
         compiled from templates/newsletter/newsletter.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'templates/newsletter/newsletter.html', 24, false),)), $this); ?>
<html>
<head>
	<title>Willow Nettica - <?php echo $this->_tpl_vars['data']['newsletter_title']; ?>
</title>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />	
	<?php echo '
	<style type="text/css">
	.list a {color: #cc0000; text-transform: uppercase; font-family: Verdana; font-size: 11px; text-decoration: none;}
	</style>
	'; ?>

</head>
<body marginheight="0" topmargin="0" marginwidth="0" bgcolor="#c5c5c5" leftmargin="0">

<table cellspacing="0" border="0" style="background-image: url(/templates/newsletter/images/bg.gif); background-color: #c5c5c5;" cellpadding="0" width="100%">
	<tr>
		<td valign="top">

			<table cellspacing="0" border="0" align="center" style="background: #fff; border-right: 1px solid #ccc; border-left: 1px solid #ccc;" cellpadding="0" width="600">
				<tr>
					<td valign="top">
						<!-- header -->
						<table cellspacing="0" border="0" height="157" cellpadding="0" width="600">
							<tr>
								<td class="header-text" height="50" valign="top" style="color: #999; font-family: Verdana; font-size: 10px; text-transform: uppercase; padding: 0 20px;" width="540" colspan="2">
									<br /><br /><webversion style="color: #990000; text-decoration: none;">Willow Nettica Newsletter - <?php echo ((is_array($_tmp=$this->_tpl_vars['date'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%A, %B %e, %Y") : smarty_modifier_date_format($_tmp, "%A, %B %e, %Y")); ?>
</webversion>
								</td>
							</tr>
							<tr>
								<td class="main-title" height="5" valign="top" style="padding: 0 20px; font-size: 25px; font-family: Georgia; font-style: italic;" width="600" colspan="2">
									<?php echo $this->_tpl_vars['data']['newsletter_title']; ?>

								</td>
							</tr>
							<tr>
								<td height="20" valign="top" width="600" colspan="2">
									<img src="/templates/newsletter/images/breaker.jpg" height="20" alt="" style="border: 0;" width="600" />
								</td>
							</tr>
						</table>
						<!-- / header -->
					</td>
				</tr>
				<tr>
					<td>
						<!-- content -->
						<table cellspacing="0" border="0" height="870" cellpadding="0" width="600">
							<tr>
								<td class="content-copy" valign="top" style="padding: 0 20px; color: #000; font-size: 14px; font-family: Georgia; line-height: 20px;" colspan="2">
									<?php echo $this->_tpl_vars['data']['newsletter_content']; ?>

								</td>
							</tr>
						</table>
						<!--  / content -->
					</td>
				</tr>
				<tr>
					<td height="20" valign="top" width="600" colspan="2">
						<img src="/templates/newsletter/images/breaker.jpg" height="20" alt="" style="border: 0;" width="600" />
					</td>
				</tr>				
				<tr>
					<td valign="top" width="600">
						<!-- footer -->
						<table cellspacing="0" border="0" height="202" cellpadding="0" width="600">
							<tr>
								<td class="copyright" height="100" align="center" valign="top" style="padding: 0 20px; color: #999; font-family: Verdana; font-size: 10px; text-transform: uppercase; line-height: 20px;" width="600" colspan="2">
									Willow Nettica - Zonnebloem, Cape Town,  Cell +27 73 564 0764<br /><br />
									<?php echo ((is_array($_tmp=$this->_tpl_vars['date'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%A, %B %e, %Y") : smarty_modifier_date_format($_tmp, "%A, %B %e, %Y")); ?>
<br />
									<a style="color: #cc0000; text-decoration: none;" href="http://www.willow-nettica.co.za/" target="_blank">Willow Nettica PTY (Ltd)</a><br /><br />
									<a style="color: #cc0000; text-decoration: none; font-size: 10px;" href="http://www.willow-nettica.co.za/newsletter/unsubscribe/?email=<?php echo $this->_tpl_vars['email']; ?>
" target="_blank">Click here to unsubscribe</a>
								</td>
							</tr>
						</table>
						<!-- / end footer -->
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
</body>
</html>