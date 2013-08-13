<?php
namespace Checkuser\Entity;

class User{
 public $login;
 public $status;

 public function setLogin($login){
  $this->login=$login;
  return $this;
 }

 public function setStatus($status){
  $this->status=$status;
  return $this;
 }

public function getLogin(){
  return $this->login;
 }

 public function getStatus(){
  return $this->status;
 }

}

?>
