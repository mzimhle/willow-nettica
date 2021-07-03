<?php

function StringToFilename($string) {

	/* Remove some weird charactors that windows dont like. */
	$string = strtolower($string);
	$string = str_replace(' ' , '_' , $string);
	$string = str_replace('__' , '_' , $string);
	$string = str_replace(' ' , '_' , $string);
	$string = str_replace("é", "e", $string);
	$string = str_replace("è", "e", $string);
	$string = str_replace("`", "", $string);
	$string = str_replace("/", "_", $string);
	$string = str_replace("\\", "_", $string);
	$string = str_replace("'", "", $string);
	$string = str_replace("(", "", $string);
	$string = str_replace(")", "", $string);
	$string = str_replace("-", "_", $string);
	$string = str_replace(".", "_", $string);
	$string = str_replace("ë", "e", $string);	
	$string = str_replace('___' , '_' , $string);
	$string = str_replace('__' , '_' , $string);	
	$string = str_replace(' ' , '_' , $string);
	$string = str_replace('__' , '_' , $string);
	$string = str_replace(' ' , '_' , $string);
	$string = str_replace("é", "e", $string);
	$string = str_replace("è", "e", $string);
	$string = str_replace("`", "", $string);
	$string = str_replace("/", "_", $string);
	$string = str_replace("\\", "_", $string);
	$string = str_replace("'", "", $string);
	$string = str_replace("(", "", $string);
	$string = str_replace(")", "", $string);
	$string = str_replace("-", "_", $string);
	$string = str_replace(".", "_", $string);
	$string = str_replace("ë", "e", $string);	
	$string = str_replace("â€“", "ae", $string);	
	$string = str_replace("â", "a", $string);	
	$string = str_replace("€", "e", $string);	
	$string = str_replace("“", "", $string);	
	$string = str_replace("#", "", $string);	
	$string = str_replace("$", "", $string);	
	$string = str_replace("@", "", $string);	
	$string = str_replace("!", "", $string);	
	$string = str_replace("&", "", $string);	
	$string = str_replace(';' , '_' , $string);		
	$string = str_replace(':' , '_' , $string);		
	$string = str_replace('[' , '_' , $string);		
	$string = str_replace(']' , '_' , $string);		
	$string = str_replace('|' , '_' , $string);		
	$string = str_replace('\\' , '_' , $string);		
	$string = str_replace('%' , '_' , $string);	
	$string = str_replace(';' , '' , $string);		
	$string = str_replace(' ' , '_' , $string);
	$string = str_replace('__' , '_' , $string);
	$string = str_replace(' ' , '' , $string);	
	return $string;
			
}

function createReference($connObject, $recruiter) {
	/* New reference. */
	$reference = substr(md5(rand(123, 98745)), 1, 10);
	
	/* First check if it exists or not. */
	$itemCheck = $connObject->getByReference($recruiter, $reference);
	
	if(count($itemCheck) > 0) {
		/* It exists. check again. */
		createReference($connObject, $recruiter);
	} else {
		return $reference;
	}
}

function StringToUrl($string) {

	/* Remove some weird charactors that windows dont like. */
	$string = strtolower($string);
	$string = str_replace(' ' , '_' , $string);
	$string = str_replace('__' , '_' , $string);
	$string = str_replace(' ' , '_' , $string);
	$string = str_replace("é", "e", $string);
	$string = str_replace("è", "e", $string);
	$string = str_replace("`", "", $string);
	$string = str_replace("/", "_", $string);
	$string = str_replace("\\", "_", $string);
	$string = str_replace("'", "", $string);
	$string = str_replace("(", "", $string);
	$string = str_replace(")", "", $string);
	$string = str_replace("-", "_", $string);
	$string = str_replace(".", "_", $string);
	$string = str_replace("ë", "e", $string);
	$string = str_replace('___' , '_' , $string);
	$string = str_replace('__' , '_' , $string);

	return $string;
			
}


/* Function to generate code for account activation for jobSeekers. */
function GenerateMD5Code($email, $front = '') {
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