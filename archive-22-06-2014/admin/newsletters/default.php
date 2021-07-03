<?php
/* Add this on all pages on top. */
set_include_path($_SERVER['DOCUMENT_ROOT'].'/'.PATH_SEPARATOR.$_SERVER['DOCUMENT_ROOT'].'/library/classes/');

/*** Standard includes  */
require_once 'config/database.php';
require_once 'config/smarty.php';

require_once 'admin/includes/auth.php';

require_once 'class/newsletter.php';

$newsletterObject	= new class_newsletter();

/* Setup Pagination. */

$newsletterData = $newsletterObject->getAll('newsletter_deleted = 0','newsletter.newsletter_added DESC');
$smarty->assign('newsletterData', $newsletterData);

/* display template */
$smarty->display('admin/newsletters/default.tpl');

?>