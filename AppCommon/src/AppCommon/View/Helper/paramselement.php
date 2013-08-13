<?php
class Zend_View_Helper_Paramselement
{
	  
	public function paramselement($params,$data){
		$html='<table width="700px" style="margin-left: 0px;" cellpadding="0" cellspacing="0" border="0">
			   <tr><td width="350px" height="100%">
					  <!-- %PARAM11% -->
					  <?php 
						 if ($this->detail[PARAM_1][0][INCLUDE]==1){
						   $param_title_1="В стоимость тура включено:";  
						 } else $param_title_1="Дополнительно оплачивается:";              
					  ?>
					  <h1 style="font-size: 10pt;font-weight: 700;float:left; width: 350px;margin-left:10px;margin-right:0px;"><?php echo $param_title_1 ?><!-- В стоимость тура включено: --></h1>
					  <?php echo $this->PartialLoop("tours/detail_list_params.phtml",$this->detail[PARAM_1]); ?>
					  
					  
				   </td>
				   <td>
					  <h1 style="font-size: 10pt;font-weight: 700;float:left; width: 350px;margin-left:10px;margin-right:0px;">  <!-- Дополнительно оплачивается: --> </h1>
					  <!-- %PARAM01% -->
				   </td>
			   </tr>
			   <tr><td width="350px" height="100%" valign="top"><%PARAM12%></td><td height="100%" valign="top"><%PARAM02%></td></tr>
			</table>';
//	   if (isset(params[]))		
			
	}
	
	
	
}   
  
?>
