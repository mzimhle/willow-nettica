<?php
/* Add this on all pages on top. */
set_include_path($_SERVER['DOCUMENT_ROOT'].'/'.PATH_SEPARATOR.$_SERVER['DOCUMENT_ROOT'].'/library/classes/');


/**
 * Standard includes
 */
require_once 'config/database.php';
require_once 'config/smarty.php';


header('Location: /');
exit;
//display template
$smarty->display('web-development/default.tpl');
?>