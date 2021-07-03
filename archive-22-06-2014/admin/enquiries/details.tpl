<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8" /> 
	<title>Admin | Enquiries </title>
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
					<li><a href="/admin/enquiries/">Enquiries</a></li>
					<li><a href="#">{$enquiryData.enquiry_name}</a></li>
				</ul>
			</div>
			<div class="section">
				<div class="box">
					<div class="title">
						Enquiry Code - {$enquiryData.enquiry_reference}
						<span class="hide"></span>
					</div>
					<div class="content">
						<form id="detailsForm" name="detailsForm" action="#" method="post"  class="valid" novalidate="novalidate">					
							<div class="row">
								<label>Full Name</label>
								<div class="right">
								{$enquiryData.enquiry_name}
								</div>
							</div>
							<div class="row">
								<label>Email</label>
								<div class="right">
									{$enquiryData.enquiry_email}
								</div>
							</div>
							<div class="row">
								<label>Number</label>
								<div class="right">
									{$enquiryData.enquiry_number}
								</div>
							</div>	
							<div class="row">
								<label>Comments</label>
								<div class="right">
									{$enquiryData.enquiry_comments}
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