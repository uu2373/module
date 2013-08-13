<?php

namespace Checkuser\Model;

use Zend\Db\Adapter\Adapter;
use Zend\Db\Adapter\AdapterAwareInterface;

//use Application\Model\ModelUtils;

class ModelCheckUser{

  var $max = 12; //Кол-во заголовков новостей отображаемых на главной странице

  const SQL_TEST   = 'select count (*) as TPR from T_PA_RANGE';
  const SQL_GETNEWSARTICLE = 'select first :COUNT CI_ID,CI_CN_ID,CI_NAME from RFF$COUNTRY_INFO where CI_TYPE=2 order by CI_ID desc'; // Показ заголовков новостей
  const SQL_GETINFOCONTENT = 'select first :COUNT CI_ID,CI_CN_ID,CI_NAME,CI_CONTENT,CI_TYPE,CI_STAMP from RFF$COUNTRY_INFO where CI_ID=:COUNTRY order by CI_ID desc'; // Показ заголовков информационных
  const SQL_GETNEWSCONTENT = 'select first        CI_ID,CI_CN_ID,CI_NAME,CI_CONTENT,CI_TYPE,CI_STAMP from RFF$COUNTRY_INFO where CI_ID=:ARTICLE order by CI_ID desc';

  function setDbAdapter(Adapter $adapter) {
    $this->db = $adapter;
  }

  function getTest(){
    $res = $this->db->query(self::SQL_TEST)->execute();
    $data = $res->current();
    return $data;

  }

  function getCountArticle() {
    $res = $this->db->query(self::SQL_COUNTARTICLE)->execute();
    $data = $res->current();
    return $data;
  }

  // Список заголовков для информационных новостей (визовый везд....)
  function getInfoArticle($CN_ID) {
    $res = $this->db->query(self::SQL_GETNEWSARTICLE)->execute(array('COUNT' => $max,'COUNTRY'=>$CN_ID));
    while ($res->next()) {
      $data[] = $res->current();
    }
    return isset($data) ? $data : array();
//
//
//    if ($CN_ID) {
//      $sql = 'select first ? CI_ID,CI_CN_ID,CI_NAME,CI_CONTENT,CI_TYPE,CI_STAMP from RFF$COUNTRY_INFO where CI_ID=? order by CI_ID desc';
//      $stmt = $this->db->query($sql, array($this->max, $CN_ID));
//    } else {
//      $sql = 'select first ? CI_ID,CI_CN_ID,CI_NAME from RFF$COUNTRY_INFO where CI_TYPE=2 order by CI_ID desc';
//      $stmt = $this->db->query($sql, $this->max);
//    }
//    //while ($row=$this->tools->ToUTF8($stmt->Fetch(),array('CI_CONTENT'))){
//    while ($row = $stmt->Fetch()) {
//      //$row['CI_CONTENT']=@$this->tools->str2paragraph($row['CI_CONTENT']);
//      $row['CI_CONTENT'] = @$this->tools->toUTF8($row['CI_CONTENT']);
//      $res[$row['CI_ID']] = array_merge(array('CI_SUBJ' => $this->tools->strword($row['CI_NAME'], 47)), $row);
//    }
//
//    return $res ? $res : null;
  }

  //Список заголовков новостей
  function getNewsArticle($max = 12) {
    $res = $this->db->query(self::SQL_GETNEWSARTICLE)->execute(array('COUNT' => $max));
    while ($res->next()) {
      $data[] = $res->current();
    }
    return isset($data) ? $data : array();
  }

  function getLink($cn_id, $max = 0) {
    if ($max) {
      $max = "first $max ";
    } else {
      $max = '';
    }
    if ($cn_id) {
      $where = "CI_CN_ID=$cn_id and";
    } else {
      return null;
    }

    $sql = 'select ' . $max . 'CI_ID,CI_CN_ID,CI_NAME,CI_CONTENT,CI_TYPE from RFF$COUNTRY_INFO where ' . $where . ' CI_TYPE=1 order by CI_STAMP asc';
    //$sql='select '.$max.' CI_ID,CI_CN_ID,CI_NAME,CI_CONTENT,CI_TYPE from RFF$COUNTRY_INFO where CI_CN_ID=? and CI_TYPE=1 order by CI_STAMP asc';
    $stmt = $this->db->query($sql);
    //$res=$this->tools->ToUTF8($stmt->FetchAll());
    //$res=$stmt->FetchAll();
    $res = array();
    while ($row = $stmt->Fetch()) {
      $row['CI_CONTENT'] = $this->tools->str2paragraph($row['CI_CONTENT']);
      $res[] = $row;
    }

    return $res ? $res : array();
  }

  function GetImgByid($id) {
    try {
      $sql = 'select * from RFF$COUNTRY_FILES where (CF_CI_ID=?) and CF_SHOW=1 order by CF_ID';
      //$sql='select CF_ID, CF_NAME, CF_FILE, CF_CONTENT, CF_DEFAULT from RFF$COUNTRY_FILES where CF_CN_ID=? and CF_SHOW=1 and cf_rs_id is null and cf_rt_id is null ';
      $stmt = $this->db->query($sql, $id);
      $files = $this->tools->ToUTF8($stmt->fetchAll(), array('CF_NAME', 'CF_FILE'));
    } catch (Zend_Exception $e) {
      throw new Exception($e->getMessage());
    }
    if (empty($files))
      return (array());
    return $this->tools->GetImg($files, $this->imgdir);
  }

}

