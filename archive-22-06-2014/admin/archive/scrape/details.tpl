<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8" /> 
	<title>Admin | Archive | Scrape </title>
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
					<li><a href="/admin/archive/scrape/">Scrape</a></li>
					<li><a href="#">{if isset($spamData)}{$spamData.spam_name}{else}Add New Item{/if}</a></li>
				</ul>
			</div>
			<div class="section">
				<div class="box">
					<div class="title">
						{if isset($spamData)}{$spamData.spam_name}{else}Add New Item{/if}
						<span class="hide"></span>
					</div>
					<div class="content">
						<form id="detailsForm" name="detailsForm" action="/admin/archive/scrape/details.php{if isset($spamData)}?spamid={$spamData.pk_spam_id}{/if}" method="post">
							<div class="row">
								<label>Status</label>
								<div class="right">
								<div class="custom-radio"><input type="radio" {if isset($spamData) && $spamData.spam_active == 1}checked="checked"{/if} id="spam_active" value="1" name="statusbutton"><label for="spam_active" class="checked">Active</label></div> 
								<div class="custom-radio"><input type="radio" {if isset($spamData) && $spamData.spam_active == 0}checked="checked"{/if} id="spam_non_active" value="2" name="statusbutton"><label for="spam_non_active" class="">Non Active</label></div> 
								<div class="custom-radio"><input type="radio"  {if isset($spamData) && $spamData.spam_deleted == 1}checked="checked"{/if} id="spam_deleted" value="3" name="statusbutton"><label for="spam_deleted" class="">Delete</label></div> 
								</div>
							</div>
							<div class="row">
								<label>Spam Type</label>
								<div class="right">
									{if isset($spamtypePairs)} 
									<select id="fk_spamType_id" name="fk_spamType_id">
										<option value=""> ---- </option>
										{html_options options=$spamtypePairs selected=$spamData.fk_spamType_id}</td>
									</select>
									{else}
										<input type="hidden" id="fk_spamType_id" name="fk_spamType_id" value="" />
										<span class="error">Please add a type</span>
									{/if}
								</div>
							</div>							
							<div class="row">
								<label>Name</label>
								<div class="right">
								<input type="text" name="spam_name" id="spam_name" size="40" value="{$spamData.spam_name}"  />
								</div>
							</div>
							<div class="row">
								<label>Email</label>
								<div class="right">
									<input type="text" name="spam_email" id="spam_email" size="40" value="{$spamData.spam_email}"  />
								</div>
							</div>
							<div class="row">
								<label>Number</label>
								<div class="right">
							<input type="text" name="spam_number" id="spam_number" size="40" value="{$spamData.spam_number}"  />
								</div>
							</div>	
							<div class="row">
								<label>Fax</label>
								<div class="right">
							<input type="text" name="spam_fax" id="spam_fax" size="40" value="{$spamData.spam_fax}" />
								</div>
							</div>
							<div class="row">
								<label>Link</label>
								<div class="right">
							<input type="text" name="spam_link" id="spam_link" size="40" value="{$spamData.spam_link}"  />
								</div>
							</div>
							<div class="row">
								<label>Referer Link</label>
								<div class="right">
									<input type="text" name="spam_referer" id="spam_referer" size="40" value="{$spamData.spam_referer}"  />
								</div>
							</div>	
								<div class="section">
									<div class="box">
										<div class="title">
											More Text
											<span class="hide"></span>
										</div>
										<div class="content nopadding">
											<form action="">
													<textarea rows="" name="spam_text" id="spam_text"  cols="" class="wysiwyg" style="height : 500px;">{$accountData.spam_text}</textarea>
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