<?php

function StringToUrl($name) {

	/* Remove some weird charactors that windows dont like. */
	$name = strtolower(trim($name));
	$name = str_replace(' ' , '_' , $name);
	$name = str_replace('__' , '_' , $name);
	$name = str_replace(' ' , '_' , $name);
	$name = str_replace("é", "e", $name);
	$name = str_replace("è", "e", $name);
	$name = str_replace("`", "", $name);
	$name = str_replace("/", "_", $name);
	$name = str_replace("\\", "_", $name);
	$name = str_replace("'", "", $name);
	$name = str_replace("(", "", $name);
	$name = str_replace(")", "", $name);
	$name = str_replace("-", "_", $name);
	$name = str_replace(".", "_", $name);
	$name = str_replace("ë", "e", $name);	
	$name = str_replace("â€“", "ae", $name);	
	$name = str_replace("â", "a", $name);	
	$name = str_replace("€", "e", $name);	
	$name = str_replace("“", "", $name);	
	$name = str_replace("#", "", $name);	
	$name = str_replace("$", "", $name);	
	$name = str_replace("@", "", $name);	
	$name = str_replace("!", "", $name);	
	$name = str_replace("&", "", $name);	
	$name = str_replace(';' , '_' , $name);		
	$name = str_replace(':' , '_' , $name);		
	$name = str_replace('[' , '_' , $name);		
	$name = str_replace(']' , '_' , $name);		
	$name = str_replace('|' , '_' , $name);		
	$name = str_replace('\\' , '_' , $name);		
	$name = str_replace('%' , '_' , $name);	
	$name = str_replace(';' , '' , $name);		
	$name = str_replace(' ' , '_' , $name);
	$name = str_replace('__' , '_' , $name);
	$name = str_replace(' ' , '' , $name);	
	
	return $name;			
}

function StringToUrl_Areas($name) {

	/* Remove some weird charactors that windows dont like. */
	$name = strtolower(trim($name));
	$name = str_replace(' ' , '' , $name);
	$name = str_replace('__' , '' , $name);
	$name = str_replace(' ' , '' , $name);
	$name = str_replace("é", "e", $name);
	$name = str_replace("è", "e", $name);
	$name = str_replace("`", "", $name);
	$name = str_replace("/", "", $name);
	$name = str_replace("\\", "", $name);
	$name = str_replace("'", "", $name);
	$name = str_replace("(", "", $name);
	$name = str_replace(")", "", $name);
	$name = str_replace("-", "", $name);
	$name = str_replace(".", "", $name);
	$name = str_replace("ë", "e", $name);	

	return $name;			
}

/* Function to generate code for account activation for jobSeekers. */
function GenerateMD5Code($email, $front) {
	return $front.md5($email);			
}

/* Convert word or text to simple text. */
function parseWord($userDoc) {
	$fileHandle = fopen($userDoc, "r");
	$line = @fread($fileHandle, filesize($userDoc));   
	$lines = explode(chr(0x0D),$line);
	$outtext = "";
	foreach($lines as $thisline)
	  {
		$pos = strpos($thisline, chr(0x00));
		if (($pos !== FALSE)||(strlen($thisline)==0))
		  {
		  } else {
			$outtext .= $thisline." ";
		  }
	  }
	 $outtext = preg_replace("/[^a-zA-Z0-9\s\,\.\-\n\r\t@\/\_\(\)]/","",$outtext);
	return $outtext;
} 

?>