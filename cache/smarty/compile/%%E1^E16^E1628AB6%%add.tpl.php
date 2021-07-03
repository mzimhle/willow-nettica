<?php /* Smarty version 2.6.20, created on 2013-11-09 10:07:10
         compiled from admin/archive/calendar/add.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'default', 'admin/archive/calendar/add.tpl', 32, false),array('function', 'html_options', 'admin/archive/calendar/add.tpl', 44, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<link rel="stylesheet" type="text/css" href="/admin/css/table.css" />
	
	<script type="text/javascript" src="/admin/library/javascript/jquery-1.7.1.min.js"></script>
	<script type="text/javascript" src="/admin/library/javascript/jquery.ui.1.8.17.js"></script>
	
	<script type="text/javascript" src="/library/javascript/nicedit/nicEdit.js"></script>
	
	<!--// Start Calendar //-->
	<link href="/library/javascript/calendar/calendar-blue.css" rel="stylesheet" type="text/css" />
	<script language="JavaScript" type="text/javascript" src="/library/javascript/calendar/calendar.js"></script>
	<script language="JavaScript" type="text/javascript" src="/library/javascript/calendar/calendar-en.js"></script>
	<script language="JavaScript" type="text/javascript" src="/library/javascript/calendar/calendar-setup.js"></script>
	<!--// End Calendar //-->
	<?php echo '
	<style type="text/css">
		.error {
			border: 1px solid red !important;
			color: red;
		}
	</style>
	'; ?>

</head>
<body>
	<form id="form" name="form" method="post" action="/admin/archive/calendar/add.php<?php if (isset ( $this->_tpl_vars['calendarData']['pk_calendar_id'] )): ?>?id=<?php echo $this->_tpl_vars['calendarData']['pk_calendar_id']; ?>
<?php endif; ?>">
	<div id="stylized" class="myform" style="float: left;">		
		<h1><?php if (isset ( $this->_tpl_vars['calendarData']['pk_calendar_id'] )): ?>Update date item<?php else: ?>Add new item<?php endif; ?></h1>
		<p><?php echo ((is_array($_tmp=@$this->_tpl_vars['success'])) ? $this->_run_mod_handler('default', true, $_tmp, "Add/update content to the calendar, to book appointments, work schedule and tasks.") : smarty_modifier_default($_tmp, "Add/update content to the calendar, to book appointments, work schedule and tasks.")); ?>
</p>

		<label>Description
		<span class="small">Name of item</span>
		</label>
		<input type="text" name="calendar_name" id="calendar_name" <?php if (isset ( $this->_tpl_vars['errorArray']['calendar_name'] )): ?>class="error"<?php endif; ?> value="<?php echo $this->_tpl_vars['calendarData']['calendar_name']; ?>
" />

		<label>Item Type
		<span class="small">What type of booking are you doing?</span>
		</label>
		<select id="fk_calendarType_id" name="fk_calendarType_id"  <?php if (isset ( $this->_tpl_vars['errorArray']['fk_calendarType_id'] )): ?>class="error"<?php endif; ?> >
			<option value=""> ---- </option>
			<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['calendartypePairs'],'selected' => $this->_tpl_vars['calendarData']['fk_calendarType_id']), $this);?>
</td>
		</select>
		
		<label>Client
		<span class="small">Which client is this for?</span>
		</label>
		<select id="fk_client_reference" name="fk_client_reference">
			<option value=""> ---- </option>
			<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['clientPairs'],'selected' => $this->_tpl_vars['calendarData']['fk_client_reference']), $this);?>
</td>
		</select>

		<label>Domain
		<span class="small">Which website is this for?</span>
		</label>
		<select id="fk_domain_id" name="fk_domain_id">
			<option value=""> ---- </option>
			<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['domainPairs'],'selected' => $this->_tpl_vars['calendarData']['fk_domain_id']), $this);?>
</td>
		</select>
		
		<label>Invoice Reference
		<span class="small">Is there an invoice for this?</span>
		</label>		
		<input type="text" id="fk_invoice_reference" name="fk_invoice_reference" value="<?php echo $this->_tpl_vars['calendarData']['fk_invoice_reference']; ?>
" />
		
		<div class="spacer"></div>
		<label>Start Date
		<span class="small">Start of the item</span>
		</label>
		<div id="inputcontent">
			<input type="hidden" id="calendar_from" name="calendar_from" value="<?php echo $this->_tpl_vars['calendarData']['calendar_from']; ?>
" onchange="document.getElementById('startDateShow').innerHTML = this.value;" />		
			<strong><span id="startDateShow" <?php if (isset ( $this->_tpl_vars['errorArray']['calendar_from'] )): ?>class="error"<?php endif; ?>><?php echo ((is_array($_tmp=@$this->_tpl_vars['calendarData']['calendar_from'])) ? $this->_run_mod_handler('default', true, $_tmp, 'From Date') : smarty_modifier_default($_tmp, 'From Date')); ?>
</span></strong>
			<img align="left" id="startButton" name="startButton" style="margin: 0 5px 5px; cursor: hand;" src="/admin/images/calendar.gif" style="cursor:pointer" width="15" height="15" hspace="0" vspace="0" border="0" alt="Calendar picker" /> 			
		</div>
		
		<div class="spacer"></div>
		<label>End Date
		<span class="small">End of the item</span>
		</label>
		<div id="inputcontent">
			<input type="hidden" id="calendar_to" name="calendar_to" value="<?php echo $this->_tpl_vars['calendarData']['calendar_to']; ?>
" onchange="document.getElementById('endDateShow').innerHTML = this.value;" />	
			<strong><span id="endDateShow" <?php if (isset ( $this->_tpl_vars['errorArray']['calendar_to'] )): ?>class="error"<?php endif; ?>><?php echo ((is_array($_tmp=@$this->_tpl_vars['calendarData']['calendar_to'])) ? $this->_run_mod_handler('default', true, $_tmp, 'From To') : smarty_modifier_default($_tmp, 'From To')); ?>
</span></strong>
			<img align="left" id="endButton" name="endButton" style="margin: 0 5px 5px; cursor: hand;" src="/admin/images/calendar.gif" style="cursor:pointer" width="15" height="15" hspace="0" vspace="0" border="0" alt="Calendar picker" /> 			
		</div>
		
		<div class="spacer"></div>
	</div>
	<div id="stylized" class="myform"  style="float: right;">		
		<textarea id="calendar_description" name="calendar_description" cols="47" rows="17"><?php echo $this->_tpl_vars['calendarData']['calendar_description']; ?>
</textarea><br />	
		<button onclick="javascript:submitForm();">Save</button>			
	</div>
</form>	
<?php echo '
	<script type="text/javascript" language="javascript">
	//setup calendar picker
	Calendar.setup({
		inputField : "calendar_from", // ID of the input field
		ifFormat   : "%Y-%m-%d %H:%M",       // the date format
		button     : "startButton",   // ID of the button
		showsTime  : true
	});
	
	Calendar.setup({
		inputField : "calendar_to", // ID of the input field
		ifFormat   : "%Y-%m-%d %H:%M",       // the date format
		button     : "endButton",   // ID of the button
		showsTime  : true
	});
	
	new nicEditor({
		iconsPath	: \'/library/javascript/nicedit/nicEditorIcons.gif\',
		buttonList 	: [\'bold\',\'italic\',\'underline\',\'left\',\'center\', \'ol\', \'ul\', \'xhtml\', \'fontFormat\', \'fontFamily\', \'fontSize\', \'unlink\', \'link\', \'strikethrough\', \'superscript\', \'subscript\'],
		Height : \'800\',
		Width 	: \'900\',
	}).panelInstance(\'calendar_description\');
		
	function submitForm() {
		nicEditors.findEditor(\'calendar_description\').saveContent();
		document.forms.form.submit();		
		return false;		
	}
		
	</script>
'; ?>

</body>
</html>