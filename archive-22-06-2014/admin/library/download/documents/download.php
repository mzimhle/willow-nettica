<?php
/* Add this on all pages on top. */
set_include_path($_SERVER['DOCUMENT_ROOT'].'/'.PATH_SEPARATOR.$_SERVER['DOCUMENT_ROOT'].'/library/classes/');

/**
 * Standard includes
 */
require_once 'config/database.php';
require_once 'config/smarty.php';

require_once 'admin/includes/auth.php';

/* objects. */
require_once 'class/document.php';
require_once 'File.php';

$documentObject	= new class_document();
$fileObject				= new File();
$reference			= isset($_REQUEST['reference']) && trim($_REQUEST['reference']) != '' ? trim($_REQUEST['reference']) : '';

$documentData = $documentObject->getByReference($reference);

if(count($documentData) > 0) {
		
		$file					= 	$_SERVER['DOCUMENT_ROOT'].$documentData['document_filepath'];
		$validMimeType	= $fileObject->file_content_type($file);
					
		header("Content-Type: $validMimeType");
		header("Cache-Control: no-cache");
		header("Accept-Ranges: none");
		header("Content-Disposition: attachment; filename=\"".$documentData['document_filename']."\"");			
		
		echo file_get_contents($file);
		exit;		

} else {
	echo 'Invalid reference';
	exit;
}


?>