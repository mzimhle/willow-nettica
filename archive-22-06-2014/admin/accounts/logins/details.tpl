<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8" /> 
	<title>Admin | Accounts | Logins </title>
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
					<li><a href="/admin/accounts/">Accounts</a></li>
					<li><a href="/admin/accounts/logins/">Logins</a></li>
					<li><a href="#">{if isset($accountData)}{$accountData.account_name}{else}Add New Account{/if}</a></li>
				</ul>
			</div>
			<div class="section">
				<div class="box">
					<div class="title">
						{if isset($accountData)}{$accountData.account_name}{else}Add New Account{/if}
						<span class="hide"></span>
					</div>
					<div class="content">
						<form id="detailsForm" name="detailsForm" action="/admin/accounts/logins/details.php{if isset($accountData)}?reference={$accountData.pk_account_id}{/if}" method="post">
							<div class="row">
							<label>Status</label>
							<div class="right">
							<div class="custom-radio"><input type="radio" {if isset($accountData) && $accountData.account_active == 1}checked="checked"{/if} id="account_active" value="1" name="statusbutton"><label for="account_active" class="checked">Active</label></div> 
							<div class="custom-radio"><input type="radio" {if isset($accountData) && $accountData.account_active == 0}checked="checked"{/if} id="account_non_active" value="2" name="statusbutton"><label for="account_non_active" class="">Non Active</label></div> 
							<div class="custom-radio"><input type="radio"  {if isset($accountData) && $accountData.account_deleted == 1}checked="checked"{/if} id="account_deleted" value="3" name="statusbutton"><label for="account_deleted" class="">Delete</label></div> 
							</div>
							</div>							
							<div class="row">
								<label>Client Account</label>
								<div class="right">
									{if isset($clientPairs)} 
									<select id="fk_client_reference" name="fk_client_reference">
										<option value=""> ---- </option>
										{html_options options=$clientPairs selected=$accountData.fk_client_reference}</td>
									</select>
									{else}
										<input type="hidden" id="fk_client_reference" name="fk_client_reference" value="" />
										<span class="error">Please add a client before adding a recovery account.</span>
									{/if}
								</div>
							</div>
							<div class="row">
								<label>Account Name</label>
								<div class="right">
									<input type="text" name="account_name" id="account_name" size="40" value="{$accountData.account_name}"/>
								</div>
							</div>
							<div class="row">
								<label>Username / Email</label>
								<div class="right">
								<input type="text" name="account_username" id="account_username" size="40" value="{$accountData.account_username}" />
								</div>
							</div>	
							<div class="row">
								<label>Password</label>
								<div class="right">
								<input type="text" name="account_password" id="account_password" size="40" value="{$accountData.account_password}" />
								</div>
							</div>
							<div class="row">
								<label>Web Link</label>
								<div class="right">
								<input type="text" name="account_link" id="account_link" size="40" value="{$accountData.account_link}" />
								</div>
							</div>
							<div class="row">
								<label>Recovery</label>
								<div class="right">
								{if isset($accountPairs)} 
								<select id="fk_recovery_account" name="fk_recovery_account">
									<option value=""> ---- </option>
									{html_options options=$accountPairs selected=$accountData.fk_recovery_account}</td>
								</select>
								{else}
									<input type="hidden" id="fk_recovery_account" name="fk_recovery_account" value="" />
									<span class="error">Please add an account before adding a recovery account.</span>
								{/if}
								</div>
							</div>
								<div class="section">
									<div class="box">
										<div class="title">
											Description
											<span class="hide"></span>
										</div>
										<div class="content nopadding">
											<form action="">
													<textarea rows="" name="account_description" id="account_description"  cols="" class="wysiwyg" style="height : 500px;">{$accountData.account_description}</textarea>
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