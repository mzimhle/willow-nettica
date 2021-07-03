<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8" /> 
	<title>Admin | Archive | Services </title>
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
					<li><a href="/admin/archive/services/">Services</a></li>
					<li><a href="#">{if isset($serviceData)}{$serviceData.service_name}{else}Add New Service Provider{/if}</a></li>
				</ul>
			</div>
			<div class="section">
				<div class="box">
					<div class="title">
						{if isset($serviceData)}{$serviceData.service_name}{else}Add New Service Provider{/if}
						<span class="hide"></span>
					</div>
					<div class="content">
						<form id="detailsForm" name="detailsForm" action="/admin/archive/services/details.php{if isset($serviceData)}?reference={$serviceData.service_reference}{/if}" method="post">
							<div class="row">
							<label>Status</label>
							<div class="right">
							<div class="custom-radio"><input type="radio" {if isset($serviceData) && $serviceData.service_active == 1}checked="checked"{/if} id="service_active" value="1" name="statusbutton"><label for="service_active" class="checked">Active</label></div> 
							<div class="custom-radio"><input type="radio" {if isset($serviceData) && $serviceData.service_active == 0}checked="checked"{/if} id="service_non_active" value="2" name="statusbutton"><label for="service_non_active" class="">Non Active</label></div> 
							<div class="custom-radio"><input type="radio"  {if isset($serviceData) && $serviceData.service_deleted == 1}checked="checked"{/if} id="service_deleted" value="3" name="statusbutton"><label for="service_deleted" class="">Delete</label></div> 
							</div>
							</div>							
							<div class="row">
								<label>Service Name</label>
								<div class="right">
									<input type="text" name="service_name" id="service_name" size="40" value="{$serviceData.service_name}"/>
								</div>
							</div>
							<div class="row">
								<label>Username / Email</label>
								<div class="right">
								<input type="text" name="service_username" id="service_username" size="40" value="{$serviceData.service_username}" />
								</div>
							</div>	
							<div class="row">
								<label>Password</label>
								<div class="right">
								<input type="text" name="service_password" id="service_password" size="40" value="{$serviceData.service_password}" />
								</div>
							</div>
							<div class="row">
								<label>Web Link</label>
								<div class="right">
								<input type="text" name="service_link" id="service_link" size="40" value="{$serviceData.service_link}" />
								</div>
							</div>
							<div class="row">
								<label>Items Remaining</label>
								<div class="right">
								<input type="text" name="service_itemsRemaining" id="service_itemsRemaining" size="40" value="{$serviceData.service_itemsRemaining}" />
								</div>
							</div>							
							<div class="row">
								<label>Payment Date</label>
								<div class="right"><input type="text" class="datepicker" name="service_paymentDate" id="service_paymentDate" placeholder="yyyy-mm-dd"  value="{$serviceData.service_paymentDate}" /></div>
							</div>							
								<div class="section">
									<div class="box">
										<div class="title">
											Description
											<span class="hide"></span>
										</div>
										<div class="content nopadding">
											<form action="">
													<textarea rows="" name="service_description" id="service_description"  cols="" class="wysiwyg" style="height : 500px;">{$serviceData.service_description}</textarea>
											</form>
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