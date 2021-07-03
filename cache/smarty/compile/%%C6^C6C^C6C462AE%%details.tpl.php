<?php /* Smarty version 2.6.20, created on 2013-11-11 01:25:43
         compiled from admin/clients/companies/details.tpl */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8" /> 
	<title>Admin | Clients </title>
	<meta name="apple-mobile-web-app-capable" content="no" />
	<meta name="apple-mobile-web-app-status-bar-style" content="black" />
	<meta name="viewport" content="width=device-width,initial-scale=0.69,user-scalable=yes,maximum-scale=1.00" />
	<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'admin/includes/css.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

	<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'admin/includes/javascript.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

</head>
<body>
<div id="wrapper">
	<div id="container">
		<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'admin/includes/header.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

		<div id="left">
			<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'admin/includes/sidemenu.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

		</div>
		<div id="right">
			<div id="breadcrumbs">
				<ul>
					<li></li>
					<li><a href="/admin/">Home</a></li>
					<li><a href="/admin/clients/">Clients</a></li>
					<li><a href="/admin/clients/companies/">Companies</a></li>
					<li><a href="#"><?php if (isset ( $this->_tpl_vars['clientData'] )): ?><?php echo $this->_tpl_vars['clientData']['client_company']; ?>
<?php else: ?>Add New Client<?php endif; ?></a></li>
				</ul>
			</div>
			<div class="section">
				<div class="box">
					<div class="title">
						<?php if (isset ( $this->_tpl_vars['clientData'] )): ?><?php echo $this->_tpl_vars['clientData']['client_company']; ?>
<?php else: ?>Add New Client<?php endif; ?>
						<span class="hide"></span>
					</div>
					<div class="content">
						<form id="detailsForm" name="detailsForm" action="/admin/clients/companies/details.php<?php if (isset ( $this->_tpl_vars['clientData'] )): ?>?clientid=<?php echo $this->_tpl_vars['clientData']['pk_client_id']; ?>
<?php endif; ?>" method="post"  class="valid" novalidate="novalidate">
							<div class="row">
								<label>Status</label>
								<div class="right">
								<div class="custom-radio"><input type="radio" <?php if (isset ( $this->_tpl_vars['clientData'] ) && $this->_tpl_vars['clientData']['client_active'] == 1): ?>checked="checked"<?php endif; ?> id="client_active" value="1" name="statusbutton"><label for="client_active" class="checked">Active</label></div> 
								<div class="custom-radio"><input type="radio" <?php if (isset ( $this->_tpl_vars['clientData'] ) && $this->_tpl_vars['clientData']['client_active'] == 0): ?>checked="checked"<?php endif; ?> id="client_non_active" value="2" name="statusbutton"><label for="client_non_active" class="">Non Active</label></div> 
								<div class="custom-radio"><input type="radio"  <?php if (isset ( $this->_tpl_vars['clientData'] ) && $this->_tpl_vars['clientData']['client_deleted'] == 1): ?>checked="checked"<?php endif; ?> id="client_deleted" value="3" name="statusbutton"><label for="client_deleted" class="">Delete</label></div> 
								</div>
							</div>						
							<div class="row">
								<label>Company</label>
								<div class="right">
								<input type="text" name="client_company" id="client_company" size="40" value="<?php echo $this->_tpl_vars['clientData']['client_company']; ?>
" <?php echo 'class="{validate:{required:true, messages:{required:\'Please enter company\'}}}"'; ?>
  />
								</div>
							</div>
							<div class="row">
								<label>Contact Name</label>
								<div class="right">
									<input type="text" name="client_contact_name" id="client_contact_name" size="40" value="<?php echo $this->_tpl_vars['clientData']['client_contact_name']; ?>
"  <?php echo 'class="{validate:{required:true, messages:{required:\'Please enter a name\'}}}"'; ?>
 />
								</div>
							</div>
							<div class="row">
								<label>Contact Surname</label>
								<div class="right">
							<input type="text" name="client_contact_surname" id="client_contact_surname" size="40" value="<?php echo $this->_tpl_vars['clientData']['client_contact_surname']; ?>
"  <?php echo 'class="{validate:{required:true, messages:{required:\'Please enter surname\'}}}"'; ?>
 />
								</div>
							</div>	
							<div class="row">
								<label>Contact Position</label>
								<div class="right">
							<input type="text" name="client_contact_position" id="client_contact_position" size="40" value="<?php echo $this->_tpl_vars['clientData']['client_contact_position']; ?>
"  <?php echo 'class="{validate:{required:true, messages:{required:\'Please enter position\'}}}"'; ?>
 />
								</div>
							</div>
							<div class="row">
								<label>Contact Email</label>
								<div class="right">
							<input type="text" name="client_contact_email" id="client_contact_email" size="40" value="<?php echo $this->_tpl_vars['clientData']['client_contact_email']; ?>
"  <?php echo 'class="{validate:{required:true, messages:{required:\'Please enter email\'}}}"'; ?>
 />
								</div>
							</div>
							<div class="row">
								<label>Contact Telephone</label>
								<div class="right">
							<input type="text" name="client_contact_telephone" id="client_contact_telephone" size="40" value="<?php echo $this->_tpl_vars['clientData']['client_contact_telephone']; ?>
"  />
								</div>
							</div>	
							<div class="row">
								<label>Contact Cellphone</label>
								<div class="right">
							<input type="text" name="client_contact_cell" id="client_contact_cell" size="40" value="<?php echo $this->_tpl_vars['clientData']['client_contact_cell']; ?>
"  />
								</div>
							</div>	
							<div class="row">
								<label>Physical Address</label>
								<div class="right">
								<textarea rows="" cols="" class="grow" placeholder="" style="height : 100px;" name="client_address" id="client_address"  <?php echo 'class="{validate:{required:true, messages:{required:\'Please enter address\'}}}"'; ?>
 ><?php echo $this->_tpl_vars['clientData']['client_address']; ?>
</textarea>								
								</div>
							</div>
							<div class="row">
								<label></label>
								<div class="right">
									<input type="checkbox" name="client_paying" id="client_paying" value="1" <?php if ($this->_tpl_vars['clientData']['client_paying'] == 1): ?>CHECKED<?php endif; ?> />
									<label for="client_paying">Paying Client</label>
									<input type="checkbox" name="client_mdc" id="client_mdc" value="1" <?php if ($this->_tpl_vars['clientData']['client_mdc'] == 1): ?>CHECKED<?php endif; ?> />
									<label for="client_mdc">MDC client ?</label>
								</div>
							</div>							
							<div class="row">
								<label>Payment Date</label>
								<div class="right"><input type="text" class="datepicker" name="client_payment_date" id="client_payment_date" placeholder="yyyy-mm-dd"  value="<?php echo $this->_tpl_vars['clientData']['client_payment_date']; ?>
"  <?php echo 'class="{validate:{required:true, messages:{required:\'Please enter date\'}}}"'; ?>
 /></div>
							</div>
							<?php if (isset ( $this->_tpl_vars['clientData']['client_reference'] )): ?>														
							<div class="row">
								<label>Client Reference</label>
								<div class="right">
									<b><?php echo $this->_tpl_vars['clientData']['client_reference']; ?>
</b>
								</div>
							</div>								
							<?php endif; ?>
							<div class="row">
								<label>Area / City</label>
								<div class="right">
									<input type="text" value="<?php echo $this->_tpl_vars['clientData']['areaMap_path']; ?>
" size="79" id="areaname" name="areaname"  <?php echo 'class="{validate:{required:true, messages:{required:\'Please enter code\'}}}"'; ?>
 />
								<input type="hidden" id="fk_area_id" name="fk_area_id" value="<?php echo $this->_tpl_vars['clientData']['pk_area_id']; ?>
" />	
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
		<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => 'admin/includes/footer.php', 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

		<?php echo '
		<script type="text/javascript">
			$(document).ready(function(){
				$( "#areaname" ).autocomplete({
				  source: "/includes/areas.php",
				  minLength: 2,
				  select: function( event, ui ) {
					$(\'.selectedarea\').html(ui.item.value);
					$(\'#fk_area_id\').val(ui.item.id);
				  }
				});
			});	
		</script>
		'; ?>
				
	</div>
</div>
</body>
</html> 