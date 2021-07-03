<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8" /> 
	<title>Dashboard</title>
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
				</ul>
			</div>
			{if $userData.administrator_type eq 'SU'}
			<div class="btn-box">
				<div class="content">
					<a href="/admin/clients/" class="item">
						<img src="/admin/images/gfx/icons/big/messages.png" alt="Messages" />
						<span>Clients</span>
						Manage client details
					</a>
					<a href="/admin/domains/" class="item">
						<img src="/admin/images/gfx/icons/big/web.png" alt="Settings" />
						<span>Domains</span>
						Manage client domains
					</a>
					<a href="/admin/accounts/" class="item">
						<img src="/admin/images/gfx/icons/big/support.png" alt="Support" />
						<span>Accounts</span>
						Usernames / passwords
					</a>					
				</div>
			</div>
			<div class="btn-box">
				<div class="content">
					<a href="/admin/products/" class="item">
						<img src="/admin/images/gfx/icons/big/cart.png" alt="Products" />
						<span>Products</span>
						Products offered
					</a>				
					<a href="/admin/invoices/" class="item">
						<img src="/admin/images/gfx/icons/big/cart.png" alt="Invoices" />
						<span>Invoices</span>
						Company Invoices
					</a>					
				</div>
			</div>
			<div class="btn-box">
				<div class="content">
					<a href="/admin/archive/" class="item">
						<img src="/admin/images/gfx/icons/big/cart.png" alt="Archive" />
						<span>Archive</span>
						Company storage
					</a>				
					<a href="/admin/newsletters/" class="item">
						<img src="/admin/images/gfx/icons/big/cart.png" alt="Archive" />
						<span>Newsletters</span>
						Company newsletters
					</a>	
					<a href="/admin/enquiries/" class="item">
						<img src="/admin/images/gfx/icons/big/cart.png" alt="Invoices" />
						<span>Enquiries</span>
						Company Enquiries
					</a>					
				</div>
			</div>				
			{/if}
			{if $userData.administrator_type eq 'NE'}
			<div class="btn-box">
				<div class="content">
					<a href="/admin/archive/" class="item">
						<img src="/admin/images/gfx/icons/big/cart.png" alt="Archive" />
						<span>Archive</span>
						Company storage
					</a>				
					<a href="/admin/newsletters/" class="item">
						<img src="/admin/images/gfx/icons/big/cart.png" alt="Archive" />
						<span>Newsletters</span>
						Company newsletters
					</a>	
					<a href="/admin/enquiries/" class="item">
						<img src="/admin/images/gfx/icons/big/cart.png" alt="Invoices" />
						<span>Enquiries</span>
						Company Enquiries
					</a>					
				</div>
			</div>	
			{/if}
		</div>
		{include_php file='admin/includes/footer.php'}
	</div>
</div>
</body>
</html> 