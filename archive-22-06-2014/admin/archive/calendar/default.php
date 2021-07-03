<?php
/* Add this on all pages on top. */
set_include_path($_SERVER['DOCUMENT_ROOT'].'/'.PATH_SEPARATOR.$_SERVER['DOCUMENT_ROOT'].'/library/classes/');

/*** Standard includes  */
require_once 'config/database.php';
require_once 'config/smarty.php';

require_once 'admin/includes/auth.php';

require_once 'class/calendartype.php';

$calendartypeObject		= new class_calendartype();

$calendartypeData = $calendartypeObject->getAll();

$smarty->assign('calendartypeData', $calendartypeData);

/* display template */
$smarty->display('admin/archive/calendar/default.tpl');

?>