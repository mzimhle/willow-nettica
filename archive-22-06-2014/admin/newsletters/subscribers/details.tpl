<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8" /> 
	<title>Admin | Newsletter Subscribers </title>
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
					<li><a href="/admin/newsletters/">Newsletters</a></li>
					<li><a href="/admin/newsletters/subscribers/">Subscribers</a></li>
					<li><a href="#">{if isset($subscriberData)}{$subscriberData.subscriber_name} {$subscriberData.subscriber_surname}{else}Add New Subscriber{/if}</a></li>
				</ul>
			</div>
			<div class="section">
				<div class="box">
					<div class="title">
						{if isset($subscriberData)}{$subscriberData.subscriber_name} {$subscriberData.subscriber_surname}{else}Add New Subscriber{/if}
						<span class="hide"></span>
					</div>
					<div class="content">
						<form id="detailsForm" name="detailsForm" action="/admin/newsletters/subscribers/details.php{if isset($subscriberData)}?code={$subscriberData.subscriber_code}{/if}" method="post"  class="valid" novalidate="novalidate">
							<div class="row">
								<label>Status</label>
								<div class="right">
								<div class="custom-radio"><input type="radio" {if isset($subscriberData) && $subscriberData.subscriber_active == 1}checked="checked"{/if} id="subscriber_active" value="1" name="statusbutton"><label for="subscriber_active" class="checked">Subscribed</label></div> 
								<div class="custom-radio"><input type="radio" {if isset($subscriberData) && $subscriberData.subscriber_active == 0}checked="checked"{/if} id="subscriber_non_active" value="2" name="statusbutton"><label for="subscriber_non_active" class="">Unsubscribed</label></div> 
								<div class="custom-radio"><input type="radio"  {if isset($subscriberData) && $subscriberData.subscriber_deleted == 1}checked="checked"{/if} id="subscriber_deleted" value="3" name="statusbutton"><label for="subscriber_deleted" class="">Delete</label></div> 
								</div>
							</div>						
							<div class="row">
								<label>Name</label>
								<div class="right">
								<input type="text" name="subscriber_name" id="subscriber_name" size="40" value="{$subscriberData.subscriber_name}" {literal}class="{validate:{required:true, messages:{required:'Please enter company'}}}"{/literal}  />
								</div>
							</div>
							<div class="row">
								<label>Surname</label>
								<div class="right">
									<input type="text" name="subscriber_surname" id="subscriber_surname" size="40" value="{$subscriberData.subscriber_surname}"  {literal}class="{validate:{required:true, messages:{required:'Please enter a name'}}}"{/literal} />
								</div>
							</div>
							<div class="row">
								<label>Email</label>
								<div class="right">
							<input type="text" name="subscriber_email" id="subscriber_email" size="40" value="{$subscriberData.subscriber_email}"  {literal}class="{validate:{required:true, messages:{required:'Please enter surname'}}}"{/literal} />
								</div>
							</div>	
							<div class="row">
								<label>Cell</label>
								<div class="right">
							<input type="text" name="subscriber_cell" id="subscriber_cell" size="40" value="{$subscriberData.subscriber_cell}"  {literal}class="{validate:{required:true, messages:{required:'Please enter position'}}}"{/literal} />
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
	</div>
</div>
</body>
</html> 