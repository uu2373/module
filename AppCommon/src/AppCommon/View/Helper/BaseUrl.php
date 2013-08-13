<?php
namespace AppCommon\View\Helper;

use Zend\View\Helper\AbstractHelper;
 
class BaseUrl extends AbstractHelper{ 
	public function __invoke($file = null) 
	{ 	// Get baseUrl 
		$baseUrl = Zend_Controller_Front::getInstance()->getBaseUrl();
		//$baseUrl = substr($_SERVER['PHP_SELF'], 0, -9);
		$baseUrl=str_replace('/index.php','',$baseUrl);  
		//return $base_url;  
		 
 
		// Remove trailing slashes 
		$file = ($file !== null) ? ltrim($file, '/\\') : null;
		
		// Build return 
		$return = rtrim($baseUrl, '/\\') . (($file !== null) ? ('/' . $file) : ''); 
 
		return $return; 
	} 
} 