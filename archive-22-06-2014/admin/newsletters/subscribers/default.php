<?php
/* Add this on all pages on top. */
set_include_path($_SERVER['DOCUMENT_ROOT'].'/'.PATH_SEPARATOR.$_SERVER['DOCUMENT_ROOT'].'/library/classes/');

/*** Standard includes  */
require_once 'config/database.php';
require_once 'config/smarty.php';

require_once 'admin/includes/auth.php';

require_once 'class/subscriber.php';

$subscriberObject	= new class_subscriber();

require_once 'admin/includes/filter.php';

global $filter;

/* Setup Pagination. */

$subscriberData = $subscriberObject->getAll('subscriber_deleted = 0','subscriber.subscriber_added DESC');

$smarty->assign('subscriberItems', $subscriberData);

/* End Pagination Setup. */

/* display template */
$smarty->display('admin/newsletters/subscribers/default.tpl');

?>