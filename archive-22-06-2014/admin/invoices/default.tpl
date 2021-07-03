<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8" /> 
	<title>Dashbaord | Invoices</title>
	<meta name="apple-mobile-web-app-capable" content="no" />
	<meta name="apple-mobile-web-app-status-bar-style" content="black" />
	<meta name="viewport" content="width=device-width,initial-scale=0.69,user-scalable=yes,maximum-scale=1.00" />
	{include_php file='admin/includes/css.php'}
	{include_php file='admin/includes/javascript.php'}
</head>
<body>
<div id="wrapper">
	<div id="container">
		{include_php file='admin/includes/header.php'}
		<div id="left">
			{include_php file='admin/includes/sidemenu.php'}
		</div>
		<div id="right">
			<div id="breadcrumbs">
				<ul>
					<li></li>
					<li><a href="/admin/">Home</a></li>					
					<li><a href="/admin/invoices/">Invoices</a></li>	
				</ul>
			</div>
			<div class="btn-box">
				<div class="content">
					<a href="/admin/invoices/paid/" class="item">
						<img src="/admin/images/gfx/icons/big/messages.png" alt="Paid Invoices" />
						<span>Paid</span>
						View Paid Invoices
					</a>
					<a href="/admin/invoices/unpaid/" class="item">
						<img src="/admin/images/gfx/icons/big/web.png" alt="Unpaid Invoices" />
						<span>Unpaid</span>
						View Unpaid Invoices
					</a>
					<a href="/admin/invoices/create/" class="item">
						<img src="/admin/images/gfx/icons/big/support.png" alt="Create Invoice" />
						<span>Create</span>
						Create onceoff invoice
					</a>				
				</div>
			</div>
			<div class="btn-box">
				<div class="content">
					<a href="/admin/invoices/monthlyinvoices/" class="item">
						<img src="/admin/images/gfx/icons/big/support.png" alt="Monthly Sent Invoices" />
						<span>Monthly Invoices</span>
						Monthly sent invoices
					</a>					
				</div>			
			</div>
		</div>
		{include_php file='admin/includes/footer.php'}
	</div>
</div>
</body>
</html> 