<?php
/* Add this on all pages on top. */
set_include_path($_SERVER['DOCUMENT_ROOT'].'/'.PATH_SEPARATOR.$_SERVER['DOCUMENT_ROOT'].'/library/classes/');

require_once 'config/database.php';
require_once 'class/areaMap.php';

$items = array();

if(isset($_REQUEST['term']) && trim($_REQUEST['term']) != '') {
	$areaMapObject = new class_areaMap();
	
	$term = trim($_REQUEST['term']);
	
	$searchareas = $areaMapObject->searchAreas($term);
	
	if(count($searchareas) > 0) {
		$counter = 0;
		for($i = 0; $i < count($searchareas); $i++) {
			$items[$counter]['id'] 			= $searchareas[$i]['fkAreaId'];
			$items[$counter]['label'] 	= $searchareas[$i]['areaMap_path'];
			$items[$counter]['value'] 	= $searchareas[$i]['areaMap_path'];
			$counter++;
		}
	}
}

echo json_encode($items);
exit;
?>