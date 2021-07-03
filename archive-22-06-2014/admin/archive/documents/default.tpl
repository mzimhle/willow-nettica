<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8" /> 
	<title>Admin | Archive | Documents</title>
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
					<li><a href="/admin/archive/documents/">Documents</a></li>
				</ul>
			</div>
			<div class="btn-box">
				<div class="content">
					<div class="section">
						<div class="box">
							<div class="title">
								Documents
								<span class="hide"></span>
							</div>
							<div class="content">
								<table cellspacing="0" cellpadding="0" border="0" class="all"> 
									<thead> 
										<tr>
											<th>Added</th>
											<th>Name</th>
											<th></th>
										</tr>
									</thead>
									<tbody>
									  {foreach from=$documentData item=item}
									  <tr>
										<td align="left" class="alt">{$item.document_added|date_format}</td>	
										<td align="left" class="alt"><a href="/admin/archive/documents/details.php?reference={$item.document_reference}">{$item.document_name}</a></td>
										<td align="left" class="alt"><a href="/admin/library/download/documents/download.php?reference={$item.document_reference}" target="_blank">download</a></td>	
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