<?php

namespace AppCommon\Model;

use Zend\Db\Adapter\Adapter;
use Zend\Db\Adapter\AdapterAwareInterface;
use Zend\Db\Adapter\ParameterContainer;

class DBCommon implements AdapterAwareInterface{

  const SQL_TEST = 'select count(*) as CNT from CONTACT';
  const SQL_DOCUMENTTEMPLATE = 'select ID,CODE,TEMPLATEFILENAME,TEMPLATEBODY from DOCUMENTTEMPLATE';
  const SQL_FILETABLE = 'select ID,NAME,FILEIMAGE from FILETABLE where id = 28000';

  //const SQL_DOCUMENTTEMPLATE   = 'select ID,CODE,TEMPLATEFILENAME from DOCUMENTTEMPLATE';
  //const SQL_DOCUMENTTEMPLATE   = 'select TEMPLATEBODY from DOCUMENTTEMPLATE';


  function setDbAdapter(Adapter $adapter) {
    $this->db = $adapter;
  }

  function getCountContacts() {
    $res = $this->db->query(self::SQL_TEST)->execute();
    while ($res->next()) {
      $data[] = $res->current();
    }

    return isset($data) ? $data : array();
  }

  function getFileTable() {
    try {
      $res = $this->db->query(self::SQL_FILETABLE)->execute();
      while ($res->next()) {
        $row = $res->current();
        $row = $this->ToUTF8($row);
        $lob = $row['FILEIMAGE'];
        $e = $lob->export("/home/uukrul/php/zftsu/data/documentemplate/{$row['NAME']}");
      }
    } catch (Exception $e) {
      $e->getMessage();
    }
  }

  function getDocumentTemplate() {
    $pc = new ParameterContainer();
    $body = $b = '';
    $this->TEMPLATEBODY = null;
    //$pc->offsetSet('TEMPLATEBODY',$pc::TYPE_LOB);
    //$pc->offsetSet(1,$body,$pc::TYPE_LOB);TYPE_BINARY
    $pc->offsetSet(1, 'TEMPLATEBODY', $pc::TYPE_BINARY);
    $i = 1;
    try {
      $res = $this->db->query(self::SQL_DOCUMENTTEMPLATE)->execute();
      while ($res->next()) {
        $row = $res->current();
        $lob = $row['TEMPLATEBODY'];
        $e = $lob->export("/home/uukrul/php/zftsu/data/documentemplate/{$row['TEMPLATEFILENAME']}");
      }
    } catch (Exception $e) {
      $e->getMessage();
    }
    return isset($ee) ? $ee : array();
  }

  function ToUTF8($body, $keys = array()) {
    if (is_array($body)) {
      $res = array();
      foreach ($body as $key => $val) {
        if (is_array($val))
          $res[$key] = $this->ToUTF8($val, $keys);
        else {
          if ((empty($keys)) || (in_array($key, $keys))) {
            //$res[$key]=iconv('WINDOWS-1251',"UTF-8",$val);
            (is_string($val)) ? $res[$key] = iconv('WINDOWS-1251', "UTF-8", $val) : $res[$key] = $val;
          } else
            $res[$key] = $val;
        }
      }
    } else {
      (is_string($body)) ? $res = iconv('WINDOWS-1251', "UTF-8", $body) : $res;
    }
    return $res;
  }

  function ToParagraph($text) {
    $out = '';

    $res = @split("\r\n", $text);
    if (count($res)) {
      foreach ($res as $val) {
        $out.="\r\n<p>" . wordwrap($val, 80, "\r\n") . '</p>'; //,$End = "\r\n"
      }
    }
    return $out;
  }

  function ToFileNameID($fname, $id) {
    $res = trim($fname);
    if (empty($fname))
      return false;
    $out = array();
    preg_match('/(\S+)\.(\S+)$/', $fname, $out);
    $fname = "$id.$out[2]";
    return $fname;
  }

  function GetImg($files, $imgdir) {
    $links = null;
    foreach ($files as $id => $value) {
      if (empty($value['CF_CONTENT'])) {
        $fname = 'noimage_green.jpg';
      } else {
        $fname = "$imgdir/" . $this->ToFileNameID($value['CF_FILE'], $value['CF_ID']);
        if (!file_exists($fname)) {
          $fcontent = $value['CF_CONTENT'];
          $res = file_put_contents("$fname", $fcontent);
        }
        //self::imgresize($fname);
      }
      $links[] = array('SRC' => '/img/' . basename($fname), 'ALT' => $value['CF_NAME']);
    }
    return $links;
  }

  function strword($str, $max, $charset = 'UTF-8') {

    if (mb_strlen($str, $charset) <= $max)
      return $str;

    $splname = mb_split('(\W+)', $str);
    if (count($splname)) {
      $lent = 0;
      $res = '';
      foreach ($splname as $word) {
        $lenw = mb_strlen($word, $charset);
        if (($lent+=$lenw + 1) >= $max)
          break;
        $res.=$word . ' ';
      }
      return $res . '>>';
    }
  }

  function str2paragraph($str) {
    $out = '';
    //$res=db::GetBlob($res);
    $res = @split("\r\n", $str);
    if (count($res)) {
      foreach ($res as $val) {
        $out.="\r\n<p>" . self::ToUTF8(wordwrap($val, 80, "\r\n")) . '</p>'; //,$End = "\r\n"
        //$out.="\r\n<p>".self::ToUTF8(wordwrap($val,80,"\r\n")).'</p>';//,$End = "\r\n"
      }
    }
    return $out;
  }

  function test() {
    return "TESTPASSED";
  }

}

?>
