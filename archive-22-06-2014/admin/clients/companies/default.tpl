<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8" /> 
	<title>Admin | Clients | Companies</title>
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
					<li><a href="/admin/clients/">Clients</a></li>
					<li><a href="/admin/clients/companies/">Companies</a></li>
				</ul>
			</div>
			<div class="btn-box">
				<div class="content">
			<div class="section">
				<div class="box">
					<div class="title">
						Clients
						<span class="hide"></span>
					</div>
					<div class="content">
						<table cellspacing="0" cellpadding="0" border="0" class="all"> 
							<thead> 
								<tr>
									<th>Reference</th>
									<th>Added</th>
									<th>Company</th>
									<th>Email</th>
									<th>Number(s)</th>
									<th></th>
								</tr>
							</thead>
							<tbody>
								  {foreach from=$clientItems item=item}
								  <tr>
									<td><b>{$item.client_reference}</b></td>	
									<td>{$item.client_added|date_format}</td>		
									<td><a href="/admin/clients/companies/details.php?clientid={$item.pk_client_id}">{$item.client_company}</a></td>	
									<td>{$item.client_contact_email}</td>
									<td>{$item.client_contact_cell|default:"N/A"} / {$item.client_contact_telephone|default:"N/A"}</td>
									<td>{if $item.client_active eq '1'}<span style="color: green;">Active</span>{else}<span style="color: red;">non Active</span>{/if}</td>
								  </tr>
								  {foreachelse}
									<tr>
										<td colspan="6">There are no current items in the system.</td>
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