<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8" /> 
	<title>Admin | Products | Client Products</title>
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
					<li><a href="/admin/products/">Products</a></li>
					<li><a href="/admin/products/clientproducts/">Client Products</a></li>
				</ul>
			</div>
			<div class="btn-box">
				<div class="content">
			<div class="section">
				<div class="box">
					<div class="title">
						Products
						<span class="hide"></span>
					</div>
					<div class="content">
						<table cellspacing="0" cellpadding="0" border="0" class="all"> 
							<thead> 
								<tr>
									<th>Added</th>
									<th>Company Name</th>
									<th>Email</th>
									<th>Contact Number(s)</th>
									<th>Area</th>
								</tr>
							</thead>
							<tbody>
							  {foreach from=$clientData item=item}
								  <tr>
									<td align="left" class="alt">{$item.client_added|date_format}</td>		
									<td align="left" class="alt"><a href="/admin/products/clientproducts/details.php?reference={$item.client_reference}">{$item.client_company}</a></td>	
									<td align="left" class="alt">{$item.client_contact_email}</td>
									<td align="left" class="alt">{$item.client_contact_cell|default:"N/A"} / {$item.client_contact_telephone|default:"N/A"}</td>
									<td align="left" class="alt">{$item.areaMap_shortPath}</td>
								  </tr>
							  {/foreach}     
							</tbody>
						</table>
					</div>
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