<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8" /> 
	<title>Admin | Products | Items</title>
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
					<li><a href="/admin/products/">Clients</a></li>
					<li><a href="/admin/products/items/">Product items</a></li>
					<li><a href="#">{if isset($productData)}{$productData.product_name}{else}Add New Product Item{/if}</a></li>
				</ul>
			</div>
			<div class="section">
				<div class="box">
					<div class="title">
						{if isset($productData)}{$productData.product_name}{else}Add New Product Item{/if}
						<span class="hide"></span>
					</div>
					<div class="content">
						<form id="detailsForm" name="detailsForm" action="/admin/products/items/details.php{if isset($productData)}?reference={$productData.product_reference}{/if}" method="post">
							<div class="row">
								<label>Status</label>
								<div class="right">
								<div class="custom-radio"><input type="radio" {if isset($productData) && $productData.product_active == 1}checked="checked"{/if} id="product_active" value="1" name="statusbutton"><label for="product_active" class="checked">Active</label></div> 
								<div class="custom-radio"><input type="radio" {if isset($productData) && $productData.product_active == 0}checked="checked"{/if} id="product_non_active" value="2" name="statusbutton"><label for="product_non_active" class="">Non Active</label></div> 
								<div class="custom-radio"><input type="radio"  {if isset($productData) && $productData.product_deleted == 1}checked="checked"{/if} id="product_deleted" value="3" name="statusbutton"><label for="product_deleted" class="">Delete</label></div> 
								</div>
							</div>							
							<div class="row">
								<label>Name</label>
								<div class="right">
								<input type="text" name="product_name" id="product_name" size="40" value="{$productData.product_name}"/>
								</div>
							</div>
							<div class="row">
								<label>Price</label>
								<div class="right">
									<input type="text" name="product_price" id="product_price" size="40" value="{$productData.product_price}"/>
								</div>
							</div>
							<div class="row">
								<label>Payment Type</label>
								<div class="right">
								<select name="product_payment_type" id="product_payment_type">
									<option value="onceoff" {if $productData.product_payment_type eq 'onceoff'} SELECTED{/if}>Once Off</option>
									<option value="month" {if $productData.product_payment_type eq 'month'} SELECTED{/if}>Monthly</option>
									<option value="year" {if $productData.product_payment_type eq 'year'} SELECTED{/if}>Yearly</option>
								</select>
								</div>
							</div>	
							<div class="row">
								<label>Description</label>
								<div class="right">
									<textarea rows="3" cols="30" id="product_description" name="product_description" class="custom">{$productData.product_description}</textarea>
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