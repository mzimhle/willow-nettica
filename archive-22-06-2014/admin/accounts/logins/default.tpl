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
					<li><a href="/admin/accounts/">Accounts</a></li>
					<li><a href="/admin/accounts/logins/">Logins</a></li>
				</ul>
			</div>
			<div class="btn-box">
				<div class="content">
			<div class="section">
				<div class="box">
					<div class="title">
						Logins
						<span class="hide"></span>
					</div>
					<div class="content">
						<table cellspacing="0" cellpadding="0" border="0" class="all"> 
							<thead> 
								<tr>
									<th>Added</th>
									<th>Client Name</th>
									<th>Account Name</th>
									<th>Username / Email</th>
									<th>Password</th>
								</tr>
							</thead>
							<tbody>
							  {foreach from=$accountData item=item}
							  <tr>
								<td align="left" class="alt">{$item.account_added|date_format}</td>	
								<td align="left" class="alt">{$item.client_company}</td>	
								<td align="left" class="alt"><a href="/admin/accounts/logins/details.php?reference={$item.pk_account_id}">{$item.account_name}</a></td>
								<td align="left" class="alt">{if $item.account_link neq ''}<a href="{$item.account_link}" target="_blank">{$item.account_username}</a>{else}{$item.account_username}{/if}</td>	
								<td align="left" class="alt">{$item.account_password}</td>
							  </tr>
							  {foreachelse}
								<tr>
									<td colspan="9">There are no current items in the system.</td>
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