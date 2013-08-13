<?php

namespace DataTables\View\Helper;
use Zend\Json\Encoder;
//	Zend\View\Helper\HtmlElement;
use Zend\View\Helper\AbstractHtmlElement;

class DataTable extends AbstractHtmlElement //extends HtmlElement
{
    protected static $loaded = false;
    
	public function __invoke($id, array $attribs = array(), array $dataOpts = array()){   
	 //if (!self::$loaded) 
	 $this->load();
        $attribs['id'] = $id;
        $func=" var oTablehead =$('.$id').dataTable(".Encoder::encode($dataOpts).");";
        $js = "$(document).ready( function () {\r\n$func\r\n });";
        $this->view->HeadScript()->appendScript($js);
        
        //return sprintf('<table%s></table>', $this->_htmlAttribs($attribs));
        return ;//sprintf('<table%s></table>', $this->htmlAttribs($attribs));
	}
    
    protected function load()
    {
        if (self::$loaded) {
            return;
        }
        
        //$this->view->inlineScript()->appendFile('/js/SpiffyDataTables/jquery.dataTables.min.js');
        //$this->view->inlineScript()->appendFile('/js/jquery.dataTables.min.js');
//        $this->view->HeadScript()->appendFile('http://code.jquery.com/jquery-1.9.1.min.js');
        $this->view->HeadScript()->appendFile('/js/jquery.min.js');        
        $this->view->HeadScript()->appendFile('/js/jquery.dataTables.min.js');
        
        
        self::$loaded = true;
    }
}