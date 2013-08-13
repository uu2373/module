<?php
namespace Clients\Entity;
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Search
 *
 * @author AShvager
 */
class Search {
 protected $id;
 protected $name;

 public function SetName($name){
  $this->name=$name;
  return $this;
 }

 public function GetName(){
  return $this->name;
 }

}

?>
