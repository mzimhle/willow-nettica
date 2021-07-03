<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8" /> 
	<title>Admin | Invoices | Unpaid | {$invoiceData.client_company} - {$invoiceData.invoice_reference}</title>
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
						<form id="detailsForm" name="detailsForm" action="/admin/invoices/unpaid/details.php?reference={$invoiceData.invoice_reference}" method="post" enctype="multipart/form-data">
							{if isset($errorMessages)}
							<div class="row">
								<label>Errors:</label>
								<div class="right">
									<span>{$errorMessages}</span>
								</div>
							</div>
							{/if}							
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
								<label></label>
								<div class="right">
									<input type="checkbox" name="invoice_resend" id="invoice_resend" value="1" />
									<label for="invoice_resend">Send Invoice</label>
									
									<input type="checkbox" name="invoice_paid" id="invoice_paid" value="1" {if $invoiceData.invoice_paid eq 1}CHECKED{/if} />
									<label for="invoice_paid">Invoice Paid</label>
								
									<input type="checkbox" name="invoice_deleted" id="invoice_deleted" value="1" {if $invoiceData.invoice_deleted eq 1}CHECKED{/if} />
									<label for="invoice_deleted">Delete Invoice</label>									
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
										<th></th>
									</tr>
								</thead>
								<tbody>
								  {foreach from=$invoicefileData item=item}
								  <tr>	
									<td align="left" class="alt">{$item.invoiceFile_added|date_format}</td>
									<td align="left" class="alt">{$item.invoiceFile_description}</td>
									<td align="left" class="alt"><a href="{$item.invoiceFile_path}" target="_blank">{$item.invoiceFile_filename}</a></td>
									<td align="left" class="alt"><a href="javascript:void(0)" onclick="deletefile('{$item.invoiceFile_filename}');">delete</a></td>
								  </tr>
								  {foreachelse}
								  <tr><td colspan="5">No records found</td></tr>
								  {/foreach}   
									<tr>
										<td>{$smarty.now|date_format:'%Y-%m-%d %H:%M:%S'}</td>
										<td colspan="4"><input type="text" class="custom" id="invoiceFile_description" size="85" name="invoiceFile_description" value="" /></td>										
									</tr>
									<tr><td colspan="5"><div class="right">Upload File: <input type="file" id="invoiceFile" name="invoiceFile" /></div></td></tr>
								</tbody>
							</table>							
							</div>																					
								<div class="section">
									<div class="box">
										<div class="title">
											Notes:
											<span class="hide"></span>
										</div>
										<div class="content nopadding">
												<textarea rows="" name="invoice_notes" id="invoice_notes"  cols="" class="wysiwyg" style="height : 300px;">{$invoiceData.invoice_notes}</textarea>
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
				if(confirm('Are you sure you want to continue? Please check if you are not deleting the invoice by mistake.') == true) {
					document.forms.detailsForm.submit();					 
				}
			}
			
			function deletefile(filename) {		
				if(confirm('Are you sure you want to delete this file?') == true) {
					$.ajax({
							type: "GET",
							url: "details.php?reference={/literal}{$invoiceData.invoice_reference}{literal}&delete=1",
							data: "filename="+filename,
							dataType: "json",
							success: function(data){
									if(data.result == 1) {
										alert('Deleted');
										window.location.href = window.location.href;
									} else {
										alert(data.message);
									}
							}
					});		
				}				
			}
		</script>
		{/literal}				
	</div>
</div>
</body>
</html> 