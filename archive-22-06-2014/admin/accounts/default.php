<?php

/* Add this on all pages on top. */
set_include_path($_SERVER['DOCUMENT_ROOT'].'/'.PATH_SEPARATOR.$_SERVER['DOCUMENT_ROOT'].'/library/classes/');

/**
 * Standard admin/includes
 */
require_once 'config/smarty.php';


require_once 'admin/includes/auth.php';


 /* Display the template
 */	
$smarty->display('admin/accounts/default.tpl');
?>