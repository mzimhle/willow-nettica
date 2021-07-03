<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8" /> 
	<title>Admin | Invoices | Paid | {$invoiceData.client_company} - {$invoiceData.invoice_reference}</title>
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
					<li><a href="/admin/invoices/">Invoinces</a></li>
					<li><a href="/admin/invoices/paid/">Paid Invoinces</a></li>
					<li><a href="#">{$invoiceData.client_company} - {$invoiceData.invoice_reference}</a></li>
				</ul>
			</div>
			<div class="section">
				<div class="box">
					<div class="title">
						Invoince Details
						<span class="hide"></span>
					</div>
					<div class="content">
						<form id="detailsForm" name="detailsForm" action="/admin/invoices/details.php?reference={$invoiceData.invoice_reference}" method="post">
							<div class="row">
								<label>Reference</label>
								<div class="right">
									<span>{$invoiceData.invoice_reference}</span>
								</div>
							</div>
							<div class="row">
								<label>Client</label>
								<div class="right">
									<span>{$invoiceData.client_company}</span>
								</div>
							</div>
							<div class="row">
								<label>Invoice Total: </label>
								<div class="right">
									<span>{$invoiceData.invoice_total}</span>
								</div>
							</div>							
							<div class="row">
								<label>Due Date</label>
								<div class="right">
								<span>{$invoiceData.invoice_payment_date|date_format}</span>
								</div>
							</div>	
							<div class="row">
								<label>Payment Date</label>
								<div class="right">
								<span>{$invoiceData.invoice_paid_date|date_format}</span>
								</div>
							</div>							
							<div class="row">
							<table cellspacing="0" cellpadding="0" border="0"> 
								<thead> 
									<tr>
										<th>Name</th>
										<th>Description</th>
										<th>Price</th>
									</tr>
								</thead>
								<tbody>
								  {foreach from=$invoiceitemData item=item}
								  <tr>	
									<td align="left" class="alt">{$item.invoiceitem_name}</td>
									<td align="left" class="alt">{$item.invoiceitem_description}</td>
									<td align="left" class="alt">{$item.invoiceitem_price}</td>
								  </tr>
								  {/foreach}    
								</tbody>
							</table>	
							</div>
							<div class="row">
							<table cellspacing="0" cellpadding="0" border="0"> 
								<thead> 
									<tr>
										<th>File Added</th>
										<th>File Description</th>
										<th></th>
									</tr>
								</thead>
								<tbody>
								  {foreach from=$invoicefileData item=item}
								  <tr>	
									<td align="left" class="alt">{$item.invoiceFile_added|date_format}</td>
									<td align="left" class="alt">{$item.invoiceFile_description}</td>
									<td align="left" class="alt"><a href="{$item.invoiceFile_path}" target="_blank">{$item.invoiceFile_filename}</a></td>
								  </tr>
								  {foreachelse}
								  <tr><td colspan="3">No records found</td></tr>
								  {/foreach}   
								</tbody>
							</table>							
							</div>							
								<div class="section">
									<div class="box">
										<div class="title">
											Notes
											<span class="hide"></span>
										</div>
										<div class="content">
												{$invoiceData.invoice_notes}
										</div>
									</div>
								</div>						
						</form>
					</div>
				</div>
			</div>
		</div>
		{include_php file='admin/includes/footer.php'}			
	</div>
</div>
</body>
</html> 