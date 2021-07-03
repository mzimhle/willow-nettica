<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8" /> 
	<title>Admin | Archive | Document</title>
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
					<li><a href="/admin/archive/documents/">Documents</a></li>
					<li><a href="#">{if isset($documentData)}{$documentData.document_name}{else}Add new document{/if}</a></li>
				</ul>
			</div>
			<div class="section">
				<div class="box">
					<div class="title">
						{if isset($documentData)}{$documentData.document_name}{else}Add New document Provider{/if}
						<span class="hide"></span>
					</div>
					<div class="content">
						<form id="detailsForm" name="detailsForm" action="/admin/archive/documents/details.php{if isset($documentData)}?reference={$documentData.document_reference}{/if}" method="post" enctype="multipart/form-data">
							<div class="row">
								<label>Status</label>
								<div class="right">
								<div class="custom-radio"><input type="radio" {if isset($documentData) && $documentData.document_active == 1}checked="checked"{/if} id="document_active" value="1" name="statusbutton"><label for="document_active" class="checked">Active</label></div> 
								<div class="custom-radio"><input type="radio" {if isset($documentData) && $documentData.document_active == 0}checked="checked"{/if} id="document_non_active" value="2" name="statusbutton"><label for="document_non_active" class="">Non Active</label></div> 
								<div class="custom-radio"><input type="radio"  {if isset($documentData) && $documentData.document_deleted == 1}checked="checked"{/if} id="document_deleted" value="3" name="statusbutton"><label for="document_deleted" class="">Delete</label></div> 
								</div>
							</div>							
							<div class="row">
								<label>Document name</label>
								<div class="right">
									<input type="text" name="document_name" id="document_name" size="40" value="{$documentData.document_name}"/>
								</div>
							</div>	
							<div class="row">
								<label>File upload</label>
								<div class="right">
									<input type="file" id="documentFile" name="documentFile" />
								</div>
							</div>	
							{if isset($documentData)}
							<div class="row">
								<label>Download</label>
								<div class="right">
									<a href="/admin/library/download/documents/download.php?reference={$documentData.document_reference}" target="_blank">{$documentData.document_filename}</a>
								</div>
							</div>				
							{/if}							
							<div class="section">
								<div class="box">
									<div class="title">
										Description
										<span class="hide"></span>
									</div>
									<div class="content nopadding">
										<form action="">
												<textarea rows="" name="document_description" id="document_description"  cols="" class="wysiwyg" style="height : 500px;">{$documentData.document_description}</textarea>
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