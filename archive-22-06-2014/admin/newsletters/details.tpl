<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8" /> 
	<title>Admin | Newsletters</title>
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
					<li><a href="/admin/newsletters/">Newsletter</a></li>
					<li><a href="#">{if isset($newsletterData)}{$newsletterData.account_name}{else}Add New Newsletter{/if}</a></li>
				</ul>
			</div>
			<div class="section">
				<div class="box">
					<div class="title">
						{if isset($newsletterData)}{$newsletterData.account_name}{else}Add New Newsletter{/if}
						<span class="hide"></span>
					</div>
					<div class="content">
						<form id="detailsForm" name="detailsForm" action="/admin/newsletters/details.php{if isset($newsletterData)}?reference={$newsletterData.newsletter_reference}{/if}" method="post">
							<div class="row">
							<label>Status</label>
							<div class="right">
							<div class="custom-radio"><input type="radio" {if isset($newsletterData) && $newsletterData.newsletter_active == 1}checked="checked"{/if} id="newsletter_active" value="1" name="statusbutton"><label for="newsletter_active" class="checked">Active</label></div> 
							<div class="custom-radio"><input type="radio" {if isset($newsletterData) && $newsletterData.newsletter_active == 0}checked="checked"{/if} id="newsletter_non_active" value="2" name="statusbutton"><label for="newsletter_non_active" class="">Non Active</label></div> 
							<div class="custom-radio"><input type="radio"  {if isset($newsletterData) && $newsletterData.newsletter_deleted == 1}checked="checked"{/if} id="newsletter_deleted" value="3" name="statusbutton"><label for="newsletter_deleted" class="">Delete</label></div> 
							</div>
							</div>							
							<div class="row">
								<label>Title</label>
								<div class="right">
									<input type="text" name="newsletter_title" id="newsletter_title" size="40" value="{$newsletterData.newsletter_title}"/>
								</div>
							</div>	
							<div class="section">
								<div class="box">
									<div class="title">
										Newsletter
										<span class="hide"></span>
									</div>
									<div class="content nopadding">
										<form action="">
												<textarea rows="" name="newsletter_content" id="newsletter_content"  cols="" class="wysiwyg" style="height : 1000px;">{$newsletterData.newsletter_content}</textarea>
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