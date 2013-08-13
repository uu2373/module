<?php
class Zend_View_Helper_Todate
{
	var $Month=array('01'=>'Январь','02'=>'Февраль','03'=>'Март','04'=>'Апрель','05'=>'Май','06'=>'Июнь','07'=>'Июль','08'=>'Август','09'=>'Сентябрь','10'=>'Октябрь','11'=>'Ноябрь','12'=>'Декабрь');	  

	private function to_date($date){
		$YYYY=substr($date,0,4); if ((1973>$YYYY) || ($YYYY>2073)) return '';
		$MM=substr($date,4,2); if (  (01>$MM)   ||   ($MM>12)  ) return '';
		$DD=substr($date,6,2); if (  (01>$DD)   ||   ($DD>31)  ) return '';
		return "$DD.$MM.$YYYY";
	}
	
	public function todate($date,$dateend){
		return($this->to_date($date)." - ". $this->to_date($dateend));
	}
	
}   
  
?>
