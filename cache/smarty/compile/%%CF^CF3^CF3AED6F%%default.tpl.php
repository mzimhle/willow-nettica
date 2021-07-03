<?php /* Smarty version 2.6.20, created on 2013-11-09 10:02:42
         compiled from admin/archive/calendar/default.tpl */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8" /> 
	<title>Admin | Archive | Services</title>
	<meta name="apple-mobile-web-app-capable" content="no" />
	<meta name="apple-mobile-web-app-status-bar-style" content="black" />
	<meta name="viewport" content="width=device-width,initial-scale=0.69,user-scalable=yes,maximum-scale=1.00" />
	<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'admin/includes/css.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

	<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'admin/includes/javascript.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

	<link rel="stylesheet" type="text/css" href="/library/javascript/jMonthCalendar-1.3.2/css/core.css" media="screen" />
	<script type="text/javascript" language="javascript" src="/library/javascript/jMonthCalendar-1.3.2/js/jMonthCalendar.js"></script>		
	<?php echo '
	<style type="text/css" media="screen">
	'; ?>
<?php $_from = $this->_tpl_vars['calendartypeData']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?><?php echo '
		#jMonthCalendar .'; ?>
<?php echo $this->_tpl_vars['item']['calendarType_class']; ?>
<?php echo ' { background-color: '; ?>
<?php echo $this->_tpl_vars['item']['calendarType_colour']; ?>
<?php echo ';}
	'; ?>
<?php endforeach; endif; unset($_from); ?><?php echo '
	</style>	
	<script type="text/javascript" language="javascript" src="/admin/includes/calendar.php"></script>
    <script type="text/javascript">
		
        $().ready(function() {
		
			var options = {
				height: 645,
				width: 941,
				navHeight: 25,
				labelHeight: 25,
				onMonthChanging: function(dateIn) {
					return false;
				}
			};

			$.jMonthCalendar.Initialize(options, events);
			
        });
		
		function datedetails(id) {				
			if(id == \'undefined\' || id == null || id == \'\') {
				$.colorbox({width:"78%", height:"520px", iframe:true, href:"/admin/archive/calendar/add.php"});
			} else {
				$.colorbox({width:"78%", height:"520px", iframe:true, href:"/admin/archive/calendar/add.php?id="+id});
			}		
		}
		
    </script>	
	'; ?>

</head>
<body>
<div id="wrapper">
	<div id="container">
		<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'admin/includes/header_wide_content.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

		<div id="left" class="sideclosed">
			<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'admin/includes/sidemenu.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

		</div>
		<div id="right" class="contentclosed">
			<div id="breadcrumbs">
				<ul>
					<li></li>
					<li><a href="/admin/">Home</a></li>
					<li><a href="/admin/archive/">Archive</a></li>
					<li><a href="/admin/archive/services/">Services</a></li>
				</ul>
			</div>
			<div class="btn-box">			
				<div class="content">
				<button type="submit" onclick="datedetails();"><span>Add</span></button>	
			<div class="section">
				<div class="box">
					<div id="jMonthCalendar" style="width: 942px !important;"></div>
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