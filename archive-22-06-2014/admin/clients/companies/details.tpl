<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8" /> 
	<title>Admin | Clients </title>
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
					<li><a href="/admin/clients/">Clients</a></li>
					<li><a href="/admin/clients/companies/">Companies</a></li>
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
						<form id="detailsForm" name="detailsForm" action="/admin/clients/companies/details.php{if isset($clientData)}?clientid={$clientData.pk_client_id}{/if}" method="post"  class="valid" novalidate="novalidate">
							<div class="row">
								<label>Status</label>
								<div class="right">
								<div class="custom-radio"><input type="radio" {if isset($clientData) && $clientData.client_active == 1}checked="checked"{/if} id="client_active" value="1" name="statusbutton"><label for="client_active" class="checked">Active</label></div> 
								<div class="custom-radio"><input type="radio" {if isset($clientData) && $clientData.client_active == 0}checked="checked"{/if} id="client_non_active" value="2" name="statusbutton"><label for="client_non_active" class="">Non Active</label></div> 
								<div class="custom-radio"><input type="radio"  {if isset($clientData) && $clientData.client_deleted == 1}checked="checked"{/if} id="client_deleted" value="3" name="statusbutton"><label for="client_deleted" class="">Delete</label></div> 
								</div>
							</div>						
							<div class="row">
								<label>Company</label>
								<div class="right">
								<input type="text" name="client_company" id="client_company" size="40" value="{$clientData.client_company}" {literal}class="{validate:{required:true, messages:{required:'Please enter company'}}}"{/literal}  />
								</div>
							</div>
							<div class="row">
								<label>Contact Name</label>
								<div class="right">
									<input type="text" name="client_contact_name" id="client_contact_name" size="40" value="{$clientData.client_contact_name}"  {literal}class="{validate:{required:true, messages:{required:'Please enter a name'}}}"{/literal} />
								</div>
							</div>
							<div class="row">
								<label>Contact Surname</label>
								<div class="right">
							<input type="text" name="client_contact_surname" id="client_contact_surname" size="40" value="{$clientData.client_contact_surname}"  {literal}class="{validate:{required:true, messages:{required:'Please enter surname'}}}"{/literal} />
								</div>
							</div>	
							<div class="row">
								<label>Contact Position</label>
								<div class="right">
							<input type="text" name="client_contact_position" id="client_contact_position" size="40" value="{$clientData.client_contact_position}"  {literal}class="{validate:{required:true, messages:{required:'Please enter position'}}}"{/literal} />
								</div>
							</div>
							<div class="row">
								<label>Contact Email</label>
								<div class="right">
							<input type="text" name="client_contact_email" id="client_contact_email" size="40" value="{$clientData.client_contact_email}"  {literal}class="{validate:{required:true, messages:{required:'Please enter email'}}}"{/literal} />
								</div>
							</div>
							<div class="row">
								<label>Contact Telephone</label>
								<div class="right">
							<input type="text" name="client_contact_telephone" id="client_contact_telephone" size="40" value="{$clientData.client_contact_telephone}"  />
								</div>
							</div>	
							<div class="row">
								<label>Contact Cellphone</label>
								<div class="right">
							<input type="text" name="client_contact_cell" id="client_contact_cell" size="40" value="{$clientData.client_contact_cell}"  />
								</div>
							</div>	
							<div class="row">
								<label>Physical Address</label>
								<div class="right">
								<textarea rows="" cols="" class="grow" placeholder="" style="height : 100px;" name="client_address" id="client_address"  {literal}class="{validate:{required:true, messages:{required:'Please enter address'}}}"{/literal} >{$clientData.client_address}</textarea>								
								</div>
							</div>
							<div class="row">
								<label></label>
								<div class="right">
									<input type="checkbox" name="client_paying" id="client_paying" value="1" {if $clientData.client_paying eq 1}CHECKED{/if} />
									<label for="client_paying">Paying Client</label>
									<input type="checkbox" name="client_mdc" id="client_mdc" value="1" {if $clientData.client_mdc eq 1}CHECKED{/if} />
									<label for="client_mdc">MDC client ?</label>
								</div>
							</div>							
							<div class="row">
								<label>Payment Date</label>
								<div class="right"><input type="text" class="datepicker" name="client_payment_date" id="client_payment_date" placeholder="yyyy-mm-dd"  value="{$clientData.client_payment_date}"  {literal}class="{validate:{required:true, messages:{required:'Please enter date'}}}"{/literal} /></div>
							</div>
							{if isset($clientData.client_reference)}														
							<div class="row">
								<label>Client Reference</label>
								<div class="right">
									<b>{$clientData.client_reference}</b>
								</div>
							</div>								
							{/if}
							<div class="row">
								<label>Area / City</label>
								<div class="right">
									<input type="text" value="{$clientData.areaMap_path}" size="79" id="areaname" name="areaname"  {literal}class="{validate:{required:true, messages:{required:'Please enter code'}}}"{/literal} />
								<input type="hidden" id="fk_area_id" name="fk_area_id" value="{$clientData.pk_area_id}" />	
								</div>
							</div>
							<div class="row">
								<label></label>
								<div class="right">
									<button type="submit"><span>Sumbit</span></button>							
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
			$(document).ready(function(){
				$( "#areaname" ).autocomplete({
				  source: "/includes/areas.php",
				  minLength: 2,
				  select: function( event, ui ) {
					$('.selectedarea').html(ui.item.value);
					$('#fk_area_id').val(ui.item.id);
				  }
				});
			});	
		</script>
		{/literal}				
	</div>
</div>
</body>
</html> 