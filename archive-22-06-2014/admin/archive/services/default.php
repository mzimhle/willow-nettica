<?php
/* Add this on all pages on top. */
set_include_path($_SERVER['DOCUMENT_ROOT'].'/'.PATH_SEPARATOR.$_SERVER['DOCUMENT_ROOT'].'/library/classes/');

/*** Standard includes  */
require_once 'config/database.php';
require_once 'config/smarty.php';

require_once 'admin/includes/auth.php';

require_once 'class/service.php';

$serviceObject	= new class_service();
 
/* Filter. */
$filter						= "service_deleted = 0";
$filter_fields				= "search_text~t"; // filter fields to remember
$filter_search_fields 	= "account_name~t"; // should be text only fields
$select_score 			= '';
$order_score 			= '';

require_once 'admin/includes/filter.php';

global $filter;

/* Setup Pagination. */

$serviceData = $serviceObject->getAll($filter,'service.service_added DESC');
$smarty->assign('serviceData', $serviceData);

/* display template */
$smarty->display('admin/archive/services/default.tpl');

?>