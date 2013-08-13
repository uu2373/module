<?php
class Zend_View_Helper_Tourslist  extends Zend_View_Helper_Abstract   
{
	  
	public function Tourslist($tour){
	  $this->view->Partial("tourshot.phtml");
	}
	
	 public $view;

	public function setView(Zend_View_Interface $view)
	{
		$this->view = $view;
	}

	public function scriptPath($script)
	{
		return $this->view->getScriptPath($script);
	}
	
	
	
}   
  
?>
