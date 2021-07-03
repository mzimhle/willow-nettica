<?php
/* Add this on all pages on top. */
set_include_path($_SERVER['DOCUMENT_ROOT'].'/'.PATH_SEPARATOR.$_SERVER['DOCUMENT_ROOT'].'/library/classes/');

/**
 * Standard includes
 */
require_once 'config/database.php';
require_once 'config/smarty.php';

/**
 * Check for login
 */
require_once 'admin/includes/auth.php';

require_once 'class/domain.php';


$domainObject = new class_domain();
 

/* Filter. */
$filter								= "domain_link != ''";
$filter_fields					= "search_text~t"; // filter fields to remember
$filter_search_fields 	= "domain_link~t"; // should be text only fields
$select_score 				= '';
$order_score 				= '';

require_once 'admin/includes/filter.php';
global $filter;

/* Setup Pagination. */
$domainData = $domainObject->getAll($filter,'domain.domain_added DESC');
$smarty->assign('domainData', $domainData);

/* 
	display template
*/
$smarty->display('admin/domains/websites/default.tpl');

?>