<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8" /> 
	<title>Admin | Invoices | Monthly Invoices</title>
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
					<li><a href="/admin/invoices/monthlyinvoices/">Monthly Invoices</a></li>
				</ul>
			</div>
			<div class="btn-box">
				<div class="content">
			<div class="section">
				<div class="box">
					<div class="title">
						Monthly Invoices
						<span class="hide"></span>
					</div>
					<div class="content">
						<table cellspacing="0" cellpadding="0" border="0" class="all"> 
							<thead> 
								<tr>
									<th>Paid</th>
									<th>Added</th>
									<th>Reference</th>
									<th>Client</th>
									<th>Email</th>
									<th>Full name</th>
									<th>Download</th>
								</tr>
							</thead>
							<tbody>
								  {foreach from=$monthlyinvoicesItems item=item}
								  <tr>
								  <td align="left" class="alt">{if $item.invoice_paid eq 1}<span style="color: green;">Paid</span>{else}<span style="color: red;">Unpaid</span>{/if}</td>		
									<td align="left" class="alt">{$item.invoiceMonthly_added|date_format:"%B %Y"}</td>		
									<td align="left" class="alt"><a href="/admin/invoices/{if $item.invoice_paid eq 0}unpaid{else}paid{/if}/details.php?reference={$item.fk_invoice_reference}">{$item.fk_invoice_reference}</a></td>	
									<td align="left" class="alt">{$item.client_company}</td>
									<td align="left" class="alt">{$item.invoiceMonthly_email}</td>
									<td align="left" class="alt">{$item.invoiceMonthly_fullname}</td>
									<td align="left" class="alt"><a href="{$item.invoice_file}" target="_blank">html</a> | <a href="/admin/library/download/invoices/download.php?reference={$item.fk_invoice_reference}" target="_blank">pdf</a></td>
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