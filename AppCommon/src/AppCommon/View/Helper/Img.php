<?php
class Zend_View_Helper_Img extends Zend_View_Helper_HtmlElement
{
	var $imgdir;
	  
	public function img($image = null, $attribs = false){
		$this->imgdir=APPLICATION_PATH . '/../public/';
		if (null !== $image) {
		   if (file_exists($this->imgdir.$image)){ 
			if ($attribs) {
				$attribs = $this->_htmlAttribs($attribs);
			} else {
				$attribs = '';
			}
			$tag = 'img src="' . $this->view->baseUrl($image) . '" ';    
			return '<' . $tag . $attribs . $this->getClosingBracket() . self::EOL;
		   
		   } else return "<!-- нет изображения-->";
		}       
	}
	
}   
  
?>
