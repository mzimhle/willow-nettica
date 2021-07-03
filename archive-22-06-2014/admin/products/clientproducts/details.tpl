<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8" /> 
	<title>Admin | Products | Client Products </title>
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
					<li><a href="/admin/products/clientproducts/">Client Products</a></li>
					<li><a href="#">{if isset($clientData)}{$clientData.client_company}{else}Add New Client{/if}</a></li>
				</ul>
			</div>
			<div class="section">
				<div class="box">
					<div class="title">
						{if isset($clientData)}{$clientData.client_company}{else}Add New Client{/if}
						<span class="hide"></span>
					</div>
					<div class="content">
						<form name="detailsForm" id="detailsForm" action="/admin/products/clientproducts/details.php?reference={$clientData.client_reference}" method="post">
						<table cellspacing="0" cellpadding="0" border="0"> 
							<thead> 
								<tr>
									<th>Added</th>
									<th>Product Name</th>
									<th>Status</th>
									<th></th>
								</tr>
							</thead>
							<tbody>
							  {foreach from=$clientProductData item=item}
							  <tr>
								<td align="left" class="alt">{$item.clientproduct_added|date_format}</td>		
								<td align="left" class="alt">
									<select id="fk_product_reference_{$item.pk_clientproduct_id}" name="fk_product_reference_{$item.pk_clientproduct_id}">
										<option value=""> ---- </option>
										{html_options options=$productPairs selected=$item.fk_product_reference}
									</select>							
								</td>	
								<td align="left" class="alt">
									<select id="clientproduct_active_{$item.pk_clientproduct_id}" name="clientproduct_active_{$item.pk_clientproduct_id}">
										<option value="1" {if $item.clientproduct_active eq 1} SELECTED {/if}>Active</option>
										<option value="0" {if $item.clientproduct_active eq 0} SELECTED {/if}>Not Active</option>
									</select> 
								</td>								
								<td align="left" class="alt">
									<button type="button" class="link link_{$item.pk_clientproduct_id}" onclick="updateForm({$item.pk_clientproduct_id}); return false;"><span>Update</span></button>	
								</td>		
							  </tr>
							  {/foreach}  
							  <tr>
								<td align="left" class="alt">{$smarty.now|date_format}</td>		
								<td align="left" class="alt">
									<select id="fk_product_reference" name="fk_product_reference">
										<option value=""> ---- </option>
										{html_options options=$productPairs selected=$clientProductData.fk_product_reference}
									</select>
								</td>							
								<td align="left" class="alt" >
									<select id="clientproduct_active" name="clientproduct_active">
										<option value="1">Active</option>
										<option value="0">Not Active</option>
									</select> 
								</td>		
								<td align="left" class="alt">
									<button type="submit" onclick="submitForm()"><span>Add</span></button>
								</td>										
							  </tr>								  
							</tbody>
						</table>
							
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
		
		function updateForm(id) {					
			$('.link_'+id).html('<b>Loading...</b>');

				$.ajax({
						type: "GET",
						url: "html.php",
						data: "clientproductid="+id+"&fk_product_reference="+$('#fk_product_reference_'+id+ ' :selected').val()+"&fk_client_reference={/literal}{$clientData.client_reference}{literal}&clientproduct_active="+$('#clientproduct_active_'+id+ ' :selected').val(),
						dataType: "json",
						success: function(data){
								if(data.result == 1) {
									alert('Updated');
									window.location.href = window.location.href;
								} else {
									alert(data.message);
								}
						}
				});	
				
				$('.link_'+id).html('Update Skill');
		}				
		</script>
		{/literal}				
	</div>
</div>
</body>
</html> 