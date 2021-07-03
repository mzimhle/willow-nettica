<?php
/* Add this on all pages on top. */
set_include_path($_SERVER['DOCUMENT_ROOT'].'/'.PATH_SEPARATOR.$_SERVER['DOCUMENT_ROOT'].'/library/classes/');

/**
 * Standard includes
 */
require_once 'config/database.php';
require_once 'config/smarty.php';

/* Other resources. */
require_once 'admin/includes/auth.php';

/* objects. */
require_once 'class/calendar.php';

$calendarObject		= new class_calendar();

$calendarData = $calendarObject->getAll();

$calendar	= array();
$i								= 0;

foreach($calendarData as $item) {
	
	$startdate	= date('Y-m-d', strtotime($item['calendar_from']));
	$enddate	= date('Y-m-d', strtotime($item['calendar_to']));
	
	$time 		= date('h:i A', strtotime($item['calendar_from']));
	
	$text	 = '';
	$text .= 'This is '.trim($item['calendarType_name']).'. At '.$time;
	
	$calendar[$i]['EventID']				= $item['pk_calendarType_id'];
	$calendar[$i]['StartDateTime'] 	= $startdate;
	$calendar[$i]['EndDateTime']		= $enddate;
	$calendar[$i]['Title']					= $item['calendar_name'].'. '.$text;
	$calendar[$i]['URL']					= 'javascript:datedetails('.$item['pk_calendar_id'].');';
	$calendar[$i]['Description']			= '';
	$calendar[$i]['CssClass']			= $item['calendarType_class'];
	if($startdate == $enddate) {
		$calendar[$i]['Title']				= trim($item['calendarType_name']).' - '.$time;
	}	
	$i++;
}

$json = json_encode($calendar);

echo 'var events = '.$json;

?>