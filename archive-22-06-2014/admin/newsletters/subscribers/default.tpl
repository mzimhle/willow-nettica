<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8" /> 
	<title>Admin | Newsletter Subscribers</title>
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
					<li><a href="/admin/newsletters/">Newsletters</a></li>
					<li><a href="/admin/newsletters/subscribers/">Subscribers</a></li>
				</ul>
			</div>
			<div class="btn-box">
				<div class="content">
			<div class="section">
				<div class="box">
					<div class="title">
						Newsletter Subscribers
						<span class="hide"></span>
					</div>
					<div class="content">
						<table cellspacing="0" cellpadding="0" border="0" class="all"> 
							<thead> 
								<tr>
									<th>Added</th>
									<th>Fullname</th>
									<th>Email</th>
									<th>Cell Number</th>
									<th></th>
								</tr>
							</thead>
							<tbody>
								  {foreach from=$subscriberItems item=item}
								  <tr>
									<td>{$item.subscriber_added|date_format}</td>		
									<td><a href="/admin/newsletters/subscribers/details.php?code={$item.subscriber_code}">{$item.subscriber_name} {$item.subscriber_surname}</a></td>	
									<td>{$item.subscriber_email}</td>
									<td>{$item.subscriber_cell|default:"N/A"}</td>
									<td>{if $item.subscriber_active eq '1'}<span style="color: green;">Subscribed</span>{else}<span style="color: red;">Unsubscribed</span>{/if}</td>
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