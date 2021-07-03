<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8" /> 
	<title>Admin | Products | Invoices | Create Invoice</title>
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
					<li><a href="#">Create an invoice</a></li>
				</ul>
			</div>
			<div class="section">
				<div class="box">
					<div class="title">
						Create an invoice
						<span class="hide"></span>
					</div>
					<div class="content">
						<form name="invoiceForm" id="invoiceForm" action="/admin/products/invoices/invoice.php" method="post">
							<div class="row">
								<label>Client</label>
								<div class="right">
									<select id="fk_client_reference" name="fk_client_reference">
										<option value=""> ---- </option>
										{html_options options=$clientPairs selected=$accountData.fk_client_reference}
									</select>	
								</div>
							</div>
							<div class="row">
								<label>Payable by</label>
								<div class="right">
									<input type="text" id="due_date" name="due_date"  placeholder="yyyy-mm-dd"  class="datepicker"  />
								</div>
							</div>
							<div class="row">
								<table cellspacing="0" cellpadding="0" border="0" class="sorting"> 
									<thead> 
										<tr>
											<th>Item</th>
											<th>Description</th>
											<th>Price</th>
											<th></th>
										</tr>
									</thead>
									<tbody>
									  {foreach from=$invoiceitem item=iteminv name=foo}
									  <tr>
										<td align="left" class="alt">{$iteminv.invoiceitem_name}</td>		
										<td align="left" class="alt">{$iteminv.invoiceitem_description}</td>	
										<td align="left" class="alt">{$iteminv.invoiceitem_price}</td>		
										<td align="left" class="alt"><a class="link" href="javascript:deleteItem({$smarty.foreach.foo.index});">Delete Item</a></td>	
									  </tr>
									  {/foreach}   								  
									</tbody>
								</table>							
							</div>	
							<input type="hidden" id="addItems" name="addItems" value="1" />
							</form>							
							<div class="row">
							<form name="itemsForm" id="itemsForm" action="/admin/products/invoices/invoice.php" method="post">
								<table cellspacing="0" cellpadding="0" border="0"> 
									<thead> 
										<tr>
											<th>Item</th>
											<th>Description</th>
											<th>Price</th>
										</tr>
									</thead>
									<tbody>
									  <tr>
										<td valign="top">
												<input type="text" id="invoice_item" class="custom" size="20" name="invoice_item" />
										</td>		
										<td valign="top">
											<textarea rows="4" cols="40" name="invoice_description" id="invoice_description" class="custom">{$invoiceData.invoice_description}</textarea>
										</td>							
										<td valign="top">
											<input type="text" name="invoice_price" size="5" id="invoice_price"  class="custom" />
										</td>	
									  </tr>									  
									</tbody>
								</table>
								<input type="hidden" id="updateItems" name="updateItems" value="1" />
							</form>														
							</div>
							<div class="row">
								<label></label>
								<div class="right">
									<button type="submit" onclick="itemsSubmitForm()"><span>Add Item</span></button>							
								</div>
							</div>							
							<div class="row">
								<label></label>
								<div class="right">
									<button type="submit" onclick="invoiceSubmitForm()"><span>Create Invoice</span></button>							
								</div>
							</div>
							{if isset($error)}
							<div class="row">
								<label></label>
								<div class="right">
									<span class="error">{$error}</span>					
								</div>
							</div>
							{/if}
						</form>
					</div>
				</div>
			</div>
		</div>
		{include_php file='admin/includes/footer.php'}
		{literal}
		<script type="text/javascript">
				
				function invoiceSubmitForm() {
					document.forms.invoiceForm.submit();					 
				}
				
				function itemsSubmitForm() {
					document.forms.itemsForm.submit();					 
				}
				
				function deleteItem(id) {					
					$.ajax({
							type: "GET",
							url: "html.php",
							data: "delete=1&deleteitem="+id,
							dataType: "json",
							success: function(data){
									if(data.result == 1) {
										alert('Item Removed');
										window.location.href = window.location.href;
									} else {
										alert(data.message);
									}
							}
					});	
				}		
		</script>
		{/literal}				
	</div>
</div>
</body>
</html> 