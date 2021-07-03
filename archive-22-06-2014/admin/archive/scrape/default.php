<?php
/* Add this on all pages on top. */
set_include_path($_SERVER['DOCUMENT_ROOT'].'/'.PATH_SEPARATOR.$_SERVER['DOCUMENT_ROOT'].'/library/classes/');

/*** Standard includes  */
require_once 'config/database.php';
require_once 'config/smarty.php';

require_once 'admin/includes/auth.php';

require_once 'class/spam.php';

$spamObject	= new class_spam();
 
/* Filter. */
$filter						= "spam_deleted = 0";
$filter_fields				= "search_text~t"; // filter fields to remember
$filter_search_fields 	= "spam_name~t"; // should be text only fields
$select_score 			= '';
$order_score 			= '';

require_once 'admin/includes/filter.php';

global $filter;

/* Setup Pagination. */

$spamData = $spamObject->getAll($filter,'spam.spam_added DESC');
$smarty->assign('spamData', $spamData);

/* display template */
$smarty->display('admin/archive/scrape/default.tpl');

?>