<?php

class File {
	
	public $allowedExtensions = array();
    public $mime_types = array(

            'txt' 		=> 'text/plain',
            'htm'	=> 'text/html',
            'html' 	=> 'text/html',
            'php' 	=> 'text/html',
            'css' 	=> 'text/css',
            'js' 		=> 'application/javascript',
            'json' 	=> 'application/json',
            'xml' 	=> 'application/xml',
            'swf' 	=> 'application/x-shockwave-flash',
            'flv' 		=> 'video/x-flv',

            // images
            'png' 	=> 'image/png',
            'jpeg' 	=> 'image/jpeg',
            'jpg' 	=> 'image/jpeg',
            'gif' 		=> 'image/gif',
            'bmp' 	=> 'image/bmp',
            'ico' 		=> 'image/vnd.microsoft.icon',
            'tiff' 		=> 'image/tiff',
            'tif' 		=> 'image/tiff',
            'svg' 	=> 'image/svg+xml',
            'svgz' 	=> 'image/svg+xml',

            // archives
            'zip' 		=> 'application/zip',
            'rar' 		=> 'application/x-rar-compressed',
            'exe' 	=> 'application/x-msdownload',
            'msi' 	=> 'application/x-msdownload',
            'cab' 	=> 'application/vnd.ms-cab-compressed',

            // audio/video
            'mp3' 	=> 'audio/mpeg',
            'qt' 		=> 'video/quicktime',
            'mov' 	=> 'video/quicktime',

            // adobe
            'pdf' 	=> 'application/pdf',
            'psd' 	=> 'image/vnd.adobe.photoshop',
            'ai' 		=> 'application/postscript',
            'eps' 	=> 'application/postscript',
            'ps' 		=> 'application/postscript',

            // ms office
            'doc' 	=> 'application/msword',
            'rtf' 		=> 'application/rtf',
            'xls' 		=> 'application/vnd.ms-excel',
            'ppt' 	=> 'application/vnd.ms-powerpoint',
			'docx' 	=> 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
			
            // open office
            'odt' 	=> 'application/vnd.oasis.opendocument.text',
            'ods' 	=> 'application/vnd.oasis.opendocument.spreadsheet',
        );	
		
	function __construct($allowedExtPar = array()) {
		$this->allowedExtensions = $allowedExtPar;
	}
	
	public function valideExt($ext) {
		
		if(in_array($ext, $this->allowedExtensions)) {
			return true;
		} else {
			return false;
		}
	}
	
	public function file_content_type($filename) {
		if(function_exists('mime_content_type')) {
			return mime_content_type($filename);
		} else {
		 $ext = strtolower(array_pop(explode('.',$filename)));
        if (array_key_exists($ext, $this->mime_types)) {
            return $this->mime_types[$ext];
        }
        elseif (function_exists('finfo_open')) {
            $finfo = finfo_open(FILEINFO_MIME);
            $mimetype = finfo_file($finfo, $filename);
            finfo_close($finfo);
            return $mimetype;
        }
        else {
            return '';
        }
		}
	}
	
	public function file_extention($filename) {
		return str_replace('.', '', '.'.end(explode('.', $filename)));
	}
	
	/*
	public function file_valid_type($filename) {
		$content_type = $this->file_content_type($filename);
		
		if($content_type != '') {
			return $content_type; 
		} else {
			return false;
		}
	}
	*/
	public function getValidMimeType($name, $ext) {
		$mime = array_search($_FILES[$name]['type'], $this->mime_types); 
		
		if($this->valideExt($ext)) {			
			return $mime;
		} else {
			return '';
		}
	}
	
	public function getMimeType($ext) {
		if($this->valideExt($ext)) {						
			return $this->mime_types[$ext];
		} else {
			return '';
		}		
	}
	
	public function getRandomFileName($appendname) {		
		return $appendname.'_'.rand(100, 1000000);
	} 
	
	public function allowedCVSize() {
		return 1310720;
	}
	
	public function getFileContents($fullpath) {
	
		return file_get_contents($fullpath);
	}
}
?>