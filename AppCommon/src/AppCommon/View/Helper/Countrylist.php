<?php
class Zend_View_Helper_Countrylist
{
	  
	public function Countrylist($country){
	 $country_str='';
	 if (!empty($country)) {   
		 foreach($country as $id=>$namecountry){
			 $country_str.=" <a href='/country/detail/$id' onfocus='this.blur();'>".$namecountry.'</a> -';
		 }
	 }
	 return trim($country_str,'-');
	}
	
	
	
}   
  
?>
