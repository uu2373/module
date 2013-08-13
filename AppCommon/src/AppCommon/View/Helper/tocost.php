<?php
class Zend_View_Helper_Tocost
{
	var $Month=array('01'=>'Январь','02'=>'Февраль','03'=>'Март','04'=>'Апрель','05'=>'Май','06'=>'Июнь','07'=>'Июль','08'=>'Август','09'=>'Сентябрь','10'=>'Октябрь','11'=>'Ноябрь','12'=>'Декабрь');	  

	private function to_cost($cost){
		return $cost;
	}
	
	public function tocost($costmin,$costmax,$rate){
		return("$costmin - $costmax $rate");
	}
	
}   
  
?>
