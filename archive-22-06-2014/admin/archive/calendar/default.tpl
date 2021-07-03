<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8" /> 
	<title>Admin | Archive | Services</title>
	<meta name="apple-mobile-web-app-capable" content="no" />
	<meta name="apple-mobile-web-app-status-bar-style" content="black" />
	<meta name="viewport" content="width=device-width,initial-scale=0.69,user-scalable=yes,maximum-scale=1.00" />
	{include_php file='admin/includes/css.php'}
	{include_php file='admin/includes/javascript.php'}
	<link rel="stylesheet" type="text/css" href="/library/javascript/jMonthCalendar-1.3.2/css/core.css" media="screen" />
	<script type="text/javascript" language="javascript" src="/library/javascript/jMonthCalendar-1.3.2/js/jMonthCalendar.js"></script>		
	{literal}
	<style type="text/css" media="screen">
	{/literal}{foreach from=$calendartypeData item=item}{literal}
		#jMonthCalendar .{/literal}{$item.calendarType_class}{literal} { background-color: {/literal}{$item.calendarType_colour}{literal};}
	{/literal}{/foreach}{literal}
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
			if(id == 'undefined' || id == null || id == '') {
				$.colorbox({width:"78%", height:"520px", iframe:true, href:"/admin/archive/calendar/add.php"});
			} else {
				$.colorbox({width:"78%", height:"520px", iframe:true, href:"/admin/archive/calendar/add.php?id="+id});
			}		
		}
		
    </script>	
	{/literal}
</head>
<body>
<div id="wrapper">
	<div id="container">
		{include_php file='admin/includes/header_wide_content.php'}
		<div id="left" class="sideclosed">
			{include_php file='admin/includes/sidemenu.php'}
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
		{include_php file='admin/includes/footer.php'}
	</div>
</div>
</body>
</html> 