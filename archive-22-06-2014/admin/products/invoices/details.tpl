<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8" /> 
	<title>Admin | Products | Invoices </title>
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
					<li><a href="/admin/products/">Accounts</a></li>
					<li><a href="/admin/products/invoices/">Invoices</a></li>
					<li><a href="#">{$invoiceData.client_company} - {$invoiceData.invoice_reference}</a></li>
				</ul>
			</div>
			<div class="section">
				<div class="box">
					<div class="title">
						Inputs and textareas
						<span class="hide"></span>
					</div>
					<div class="content">
						<form id="detailsForm" name="detailsForm" action="/admin/products/invoices/details.php?reference={$invoiceData.invoice_reference}" method="post">
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
								<span>{$invoiceData.client_payment_date|date_format}</span>
								</div>
							</div>	
							<div class="row">
								<label></label>
								<div class="right">
									<input type="checkbox" name="invoice_resend" id="invoice_resend" value="1" />
									<label for="invoice_resend">Resend Invoice</label>
									
									<input type="checkbox" name="invoice_paid" id="invoice_paid" value="1" {if $invoiceData.invoice_paid eq 1}CHECKED{/if} />
									<label for="invoice_paid">Invoice Paid ?</label>
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
								<div class="section">
									<div class="box">
										<div class="title">
											More - e.g. bank statements, etc.
											<span class="hide"></span>
										</div>
										<div class="content nopadding">
												<textarea rows="" name="invoice_more" id="invoice_more"  cols="" class="wysiwyg" style="height : 300px;">{$invoiceData.invoice_more}</textarea>
										</div>
									</div>
								</div>						
							<div class="row">
								<label></label>
								<div class="right">
									<button type="submit" onclick="submitForm()"><span>Sumbit</span></button>							
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		{include_php file='admin/includes/footer.php'}
		{literal}
		<script type="text/javascript">
			function submitForm() {
				document.forms.detailsForm.submit();					 
			}
		</script>
		{/literal}				
	</div>
</div>
</body>
</html> 