<?php
/* Add this on all pages on top. */
set_include_path($_SERVER['DOCUMENT_ROOT'].'/'.PATH_SEPARATOR.$_SERVER['DOCUMENT_ROOT'].'/library/classes/');

/*** Standard includes  */
require_once 'config/database.php';
require_once 'config/smarty.php';

require_once 'admin/includes/auth.php';

require_once 'class/product.php';

$productObject	= new class_product();


/* Filter. */
$filter					= "product_deleted = 0";
$filter_fields			= "search_text~t"; // filter fields to remember
$filter_search_fields 	= "product_company~t"; // should be text only fields
$select_score 			= '';
$order_score 			= '';

require_once 'admin/includes/filter.php';

global $filter;

/* Setup Pagination. */

$productData = $productObject->getAll($filter,'product.product_added DESC');

$smarty->assign('productData', $productData);

/* display template */
$smarty->display('admin/products/items/default.tpl');

?>