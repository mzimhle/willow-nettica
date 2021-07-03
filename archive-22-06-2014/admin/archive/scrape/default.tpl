<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8" /> 
	<title>Admin | Archive | Scrape</title>
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
									  {foreach from=$spamData item=item}
									  <tr>
										<td align="left" class="alt">{$item.spamType_name}</td>	
										<td align="left" class="alt"><a href="{$item.spam_referer}" target="_blank">Referer Link</a></td>	
										<td align="left" class="alt"><a href="/admin/archive/scrape/details.php?spamid={$item.pk_spam_id}">{$item.spam_name}</a></td>	
										<td align="left" class="alt">{$item.spam_email}</td>	
										<td align="left" class="alt">{$item.spam_fax}</td>	
										<td align="left" class="alt">{$item.spam_number}</td>	
										<td align="left" class="alt">{if $item.spam_link eq ''}N/A{else}<a href="{$item.spam_link}" target="_blank">Spam Link</a>{/if}</td>	
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