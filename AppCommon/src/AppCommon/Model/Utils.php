<?php
namespace AppCommon\Model;

class Utils{
	  
	function ToUTF8($body,$keys=array()){
		  if (is_array($body)){
			  $res=array();
			  foreach($body as $key=>$val){
				  if (is_array($val)) $res[$key]=$this->ToUTF8($val,$keys);
				  else {
					  if ( (empty($keys))  || (in_array($key,$keys)) ){
						 $res[$key]=iconv('WINDOWS-1251',"UTF-8",$val);
					  }  else $res[$key]=$val; 
				  }    
			  }              
		  } else $res=iconv('WINDOWS-1251',"UTF-8",$body);
		  
		  return $res;
	}
	
	function ToParagraph($text){
		 $out='';
		 
		 $res=@split("\r\n",$text);
		 if (count($res)){
		   foreach($res as $val){
			  $out.="\r\n<p>".wordwrap($val,80,"\r\n").'</p>';//,$End = "\r\n"
		   }
		 }
		 return $out;
	}
	
	


	function ToFileNameID($fname,$id){
	  $res=trim($fname);
	  if (empty($fname)) return false;
	  $out = array();
	  preg_match('/(\S+)\.(\S+)$/', $fname, $out);
	  $fname="$id.$out[2]";
	  return $fname;
	}
   
	  
	  
	function GetImg($files,$imgdir){
	   $links=null;
	   foreach($files as $id=>$value){
			  if (empty($value['CF_CONTENT'])){
					 $fname='noimage_green.jpg';
			  } else {
					 $fname="$imgdir/".$this->ToFileNameID($value['CF_FILE'],$value['CF_ID']);
					 if (!file_exists($fname)) {
							$fcontent=$value['CF_CONTENT'];
							$res=file_put_contents("$fname",$fcontent);
					 }
					 //self::imgresize($fname);
			  }
			$links[]=array('SRC'=>'/img/'.basename($fname),'ALT'=>$value['CF_NAME']);
	   }
	   return $links;
	}
	
	
	function strword($str,$max,$charset='UTF-8'){

	 if (mb_strlen($str,$charset) <= $max) return $str;

	 $splname=mb_split('(\W+)',$str);
	 if (count($splname)){
		 $lent=0;
		 $res='';
		 foreach ($splname as $word){
		   $lenw=mb_strlen($word,$charset);
		   if (($lent+=$lenw+1) >=$max) break;
		   $res.=$word.' ';
		 }
	  return $res.'>>';
	 }
	}
	
	
	function str2paragraph($str){
	  $out='';
	  //$res=db::GetBlob($res);
	  $res=@split("\r\n",$str);
	  if (count($res)){
		 foreach($res as $val){
		   $out.="\r\n<p>".self::ToUTF8(wordwrap($val,80,"\r\n")).'</p>';//,$End = "\r\n"
           //$out.="\r\n<p>".self::ToUTF8(wordwrap($val,80,"\r\n")).'</p>';//,$End = "\r\n"
		 }
	  }
	  return $out;
	}
	  
	function test(){
	 return "TESTPASSED";
	}	  
  }
?>
