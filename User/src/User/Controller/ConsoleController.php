<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

namespace User\Controller;
use Zend\Mvc\Controller\AbstractActionController;

class ConsoleController extends AbstractActionController{
  
  public function getVersionAction(){
    return sprintf("Current version %04.2f\n", 01.02);
  }
}

