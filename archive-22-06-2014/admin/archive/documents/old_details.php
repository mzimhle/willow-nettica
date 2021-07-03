<?php
/* Add this on all pages on top. */
set_include_path($_SERVER['DOCUMENT_ROOT'].'/'.PATH_SEPARATOR.$_SERVER['DOCUMENT_ROOT'].'/library/classes/');

/**
 * Standard includes
 */
require_once 'config/database.php';
require_once 'config/smarty.php';

/* Other resources. */
require_once 'admin/includes/auth.php';

require_once 'class/document.php';
require_once 'File.php';

$documentObject	= new class_document();
$fileObject 			= new File();

if (!empty($_GET['reference']) && $_GET['reference'] != '') {

	$reference = trim($_GET['reference']);

	$documentData = $documentObject->getByReference($reference);
	
	if(count($documentData) > 0) {
		$smarty->assign('documentData', $documentData);
	}
}

/* Check posted data. */
if(count($_POST) > 0) {

	$errorArray		= array();
	$data 				= array();
	$formValid		= true;
	$success			= NULL;
	$areaByName	= NULL;
		
	if(isset($_POST['statusbutton']) && (int)trim($_POST['statusbutton']) == 3 && isset($documentData)) {
		/* Delete account. */
		$data['document_deleted']	= 1;
		$where 	= $documentObject->getAdapter()->quoteInto('pk_document_id = ?', $documentData['pk_document_id']);
		$success 	= $documentObject->update($data, $where);	
		
		if(is_numeric($success) && $success > 0) {
			header('Location: /admin/archive/documents/');
			exit;		
		}
	}	
	
	if(isset($_FILES['documentFile'])) { 
		/* Check validity of the CV. */
		if((int)$_FILES['documentFile']['size'] == 0) {
			/* Check if its the right file. */
			$errorMessages['documentFile'] = 'Please try to upload again, its size is empty or 0.';
		}
	}
		
	if(isset($_POST['document_name']) && trim($_POST['document_name']) == '') {
		$errorArray['document_name'] = 'required';
		$formValid = false;		
	}			
	
	if(count($errorArray) == 0 && $formValid == true) {
		
		/* File uploaded, save record on database. */	
		
		$data['document_name']			= trim($_POST['document_name']);		
		$data['document_active']			= (int)trim($_POST['statusbutton']) == 1 ? 1 : 0;		
		$data['document_description'] 	= htmlspecialchars_decode(stripslashes(trim($_POST['document_description'])));	
		$reference								= isset($documentData) && trim($documentData['document_reference']) != '' ? trim($documentData['document_reference']) : $documentObject->createReference();
		
		if(isset($_FILES['documentFile'])) { 
			
			$ext 			= $fileObject->file_extention($_FILES['documentFile']['name']);		
			$oldext		= $fileObject->file_extention($documentData['document_filepath']);		
			$filename	= $reference.'.'.$ext;
			
			if(isset($documentData)) {
				/* simply replace file name. */
				$tempPath				= str_replace($documentData['document_reference'].'.'.$oldext, trim($filename), $documentData['document_filepath']);
				$file						= $_SERVER['DOCUMENT_ROOT'].$tempPath;
				
			} else {			
				/* Create folder in /media/document/ using reference. */					
				$directoryname 	= date('Y-m-d');
				$directory				= $_SERVER['DOCUMENT_ROOT']."/media/documents/".$directoryname;
				$file						= $_SERVER['DOCUMENT_ROOT']."/media/documents/".$directoryname.'/'.$filename;
				$tempPath				= "/media/documents/".$directoryname.'/'.$filename;
					
				/* Create directory. */
				if(!is_dir($directory)) mkdir($directory, 0777);
			}
			
			/* Now lets upload to this directory. */
			if(move_uploaded_file($_FILES['documentFile']['tmp_name'], $file)) {
				$data['document_filename']		= $_FILES['documentFile']['name'];
				$data['document_filepath']			= $tempPath;
			}		
		}

		if(isset($documentData)) {
			/*Update. */
			$where 	= $documentObject->getAdapter()->quoteInto('pk_document_id = ?', $documentData['pk_document_id']);
			$success 	= $documentObject->update($data, $where);
		} else {
			/* Insert. */
			$data['document_reference']	= $reference;
			$success = $documentObject->insert($data);
		}				
		
		if(is_numeric($success) && $success > 0) {
			header('Location: /admin/archive/documents/');
			exit;		
		}
		
	}		
		
	/* if we are here there are errors. */
	$smarty->assign('errorArray', $errorArray);	
	
	if(!isset($documentData)) {
		 $smarty->assign('documentData', $_POST);
	} else {
		$smarty->assign('documentData', $documentData);		
	}
}

 /* Display the template  */	
$smarty->display('admin/archive/documents/details.tpl');
?>