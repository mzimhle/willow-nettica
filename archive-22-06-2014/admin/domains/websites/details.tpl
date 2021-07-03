<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8" /> 
	<title>Admin | Domains | Websits </title>
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
					<li><a href="/admin/domains/">Domains</a></li>
					<li><a href="/admin/domains/websites/">Websites</a></li>
					<li><a href="#">{if isset($domainData)} {$domainData.domain_link}{else}Add New Domain{/if}</a></li>
				</ul>
			</div>
			<div class="section">
				<div class="box">
					<div class="title">
						{if isset($domainData)} {$domainData.domain_link}{else}Add New Domain{/if}
						<span class="hide"></span>
					</div>
					<div class="content">
						<form id="detailsForm" name="detailsForm" action="/admin/domains/websites/details.php{if isset($domainData.pk_domain_id)}?reference={$domainData.pk_domain_id}{/if}" method="post"  class="valid" novalidate="novalidate">
							<div class="row">
								<label>Status</label>
								<div class="right">
								<div class="custom-radio"><input type="radio" {if isset($domainData) && $domainData.domain_active == 1}checked="checked"{/if} id="domain_active" value="1" name="statusbutton"><label for="domain_active" class="checked">Active</label></div> 
								<div class="custom-radio"><input type="radio" {if isset($domainData) && $domainData.domain_active == 0}checked="checked"{/if} id="domain_non_active" value="2" name="statusbutton"><label for="domain_non_active" class="">Non Active</label></div> 
								<div class="custom-radio"><input type="radio"  {if isset($domainData) && $domainData.domain_deleted == 1}checked="checked"{/if} id="domain_deleted" value="3" name="statusbutton"><label for="domain_deleted" class="">Delete</label></div> 
								</div>
							</div>							
							<div class="row">
								<label>Link Address</label>
								<div class="right">
									<input type="text" name="domain_link" id="domain_link" size="40" value="{$domainData.domain_link}"  {literal}class="{validate:{required:true, messages:{required:'Please enter link'}}}"{/literal} />
								</div>
							</div>
							<div class="row">
								<label>Contact Name </label>
								<div class="right">
								<input type="text" name="domain_name" id="domain_name" size="40" placeholder="last name, first name"value="{$domainData.domain_name}"  {literal}class="{validate:{required:true, messages:{required:'Please enter name'}}}"{/literal} />
								</div>
							</div>	
							<div class="row">
								<label>Client Name</label>
								<div class="right">
									{if isset($clientPairs)} 
									<select id="fk_client_reference" name="fk_client_reference">
										<option value=""> ---- </option>
										{html_options options=$clientPairs selected=$domainData.fk_client_reference}</td>
									</select>
									{else}
										<input type="hidden" id="fk_client_reference" name="fk_client_reference" value="" />
										<span class="error">Please add a client before adding a domain.</span>
									{/if}
								</div>
							</div>
							<div class="row">
								<label>Linked Account</label>
								<div class="right">
									{if isset($accountPairs)} 
									<select id="fk_account_id" name="fk_account_id">
										<option value=""> ---- </option>
										{html_options options=$accountPairs selected=$domainData.fk_account_id}</td>
									</select>
									{else}
										<input type="hidden" id="fk_account_id" name="fk_account_id" value="" />
										<span class="error">Please add an account before adding a domain.</span>
									{/if}
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
	</div>
</div>
</body>
</html> 