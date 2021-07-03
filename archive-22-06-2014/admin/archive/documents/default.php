<?php
/* Add this on all pages on top. */
set_include_path($_SERVER['DOCUMENT_ROOT'].'/'.PATH_SEPARATOR.$_SERVER['DOCUMENT_ROOT'].'/library/classes/');

/*** Standard includes  */
require_once 'config/database.php';
require_once 'config/smarty.php';

require_once 'admin/includes/auth.php';

require_once 'class/document.php';

$documentObject	= new class_document();
 
/* Filter. */
$filter						= "document_deleted = 0";
$filter_fields				= "search_text~t"; // filter fields to remember
$filter_search_fields 	= "document_name~t"; // should be text only fields
$select_score 			= '';
$order_score 			= '';

require_once 'admin/includes/filter.php';

global $filter;

/* Setup Pagination. */

$documentData = $documentObject->getAll($filter,'document.document_added DESC');
$smarty->assign('documentData', $documentData);

/* display template */
$smarty->display('admin/archive/documents/default.tpl');

?>