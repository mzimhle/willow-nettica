<!DOCTYPE html>
<!-- HTML Start -->
<html lang="en">
<!-- Page Head Start -->
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=8" />
    <title>Willow Nettica | Contact Us</title>
	<meta name="description" content="willow nettica contact us even if you are in east london, cape town, johannesburg, durban and the rest of south africa.">                
	<meta name="keywords" content="willow nettica, contact us, east london, cape town, johannesburg, durban, rest of south africa">
	<meta name="robots" content="index, follow">
	<meta name="revisit-after" content="21 days">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta property="og:title" content="Willow Nettica"> 
	<meta property="og:image" content="http://www.willow-nettica.co.za/images/willow-nettica.png"> 
	<meta property="og:url" content="http://www.willow-nettica.co.za">
	<meta property="og:site_name" content="Willow Nettica">
	<meta property="og:type" content="website">
	<meta property="og:description" content="willow nettica contact us even if you are  for clients in east london, cape town, johannesburg, durban and the rest of south africa">			
	{include_php file='includes/javascript.php'}
	{include_php file='includes/css.php'}
</head>
<!-- Page Head End -->
<!-- Page Body Start -->
<body style="background-image: none !important;">
    <div id="background-greenbar"></div>	
    <!-- Page Wrapper Start -->
    <div id="page-wrapper">
        <div class="content-wrapper">
		{if isset($success)}
        <!-- Promotion Bar Start -->
        <div id="bar-invisible-wrapper">
            <section id="promotion-bar">
                <div id="bar-tick"></div>
            	<div class="bar-left-text"><span class="green">Success:</span> Your enquiry has been successfully sent, we will get back to you as soon as we can.</div>
            	<a href="#" class="bar-cross"></a>
            </section>
        </div>
        <!-- Promotion Bar End -->		
		{/if}
            <!-- Two Third Start -->
            <div class="content-two-third-wrapper">
            	<header class="content-two-third-header"></header>
                <div class="content-two-third-background">
                    <div class="content-two-third-body">
                        <h1>Contact Us</h1>
                        <div class="content-horizontal-rule"></div>
                        <div id="contactarea">
                        <p>Please use the form below to contact us.</p>
                        <p>
							<form id="contactForm" name="contactForm" action="/feeds/contact-us/" method="post">
								<table width="580" cellpadding="0" cellspacing="0">
									<tr>
										<td width="61">Full Name</td>
										<td width="176"><input type="text" name="enquiry_name" id="enquiry_name" value="" placeholder="e.g. Name Surname" class="contact-input {if isset($errorMessages.enquiry_name)}error{/if}"></td>
									</tr>
									<tr><td colspan="2">&nbsp;</td></tr>
									<tr>
										<td width="78" >Email</td>
										<td width="245"><input type="text" name="enquiry_email" id="enquiry_email" value="" placeholder="e.g. name.surname@domain.com"  class="contact-input {if isset($errorMessages.enquiry_email)}error{/if}"></td>								
									</tr>
									<tr><td colspan="2">&nbsp;</td></tr>
									<tr>
										<td width="78" >Number</td>
										<td width="245"><input type="text" name="enquiry_number" id="enquiry_number" value="" placeholder="e.g. 0735654825" class="contact-input {if isset($errorMessages.enquiry_number)}error{/if}"></td>								
									</tr>	
									<tr><td colspan="2">&nbsp;</td></tr>									
									<tr>
										<td>Message</td>
										<td><textarea rows="10" name="enquiry_comments" id="enquiry_comments" value="" class="contact-message {if isset($errorMessages.enquiry_comments)}error{/if}"></textarea></td>
									</tr>
									<tr><td colspan="2">&nbsp;</td></tr>
									<tr>
										<td></td>
										<td><input type="button" value="Submit" name="send" onClick="submitForm();" class="contact-submit"></td>
									</tr>
								</table>
							</form>
						</p>
                    </div>
                    </div>
                </div>
                <div class="content-two-third-footer"></div>
            </div>
            <!-- Two Third End -->
        </div>
    </div>
    <!-- Page Wrapper End -->
		{literal}
			<script type="text/javascript">	
				function submitForm() {
					document.forms.contactForm.submit();					 
				}
			</script>
		{/literal}		
	
</body>
<!-- Page Body End -->
</html>
<!-- HTML End -->                                     