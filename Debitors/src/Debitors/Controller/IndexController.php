<?php
namespace Debitors\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
//use Clients\Form\Search as Search;

class IndexController extends AbstractActionController {

 public function indexAction() {
  /*$mc = $this->getServiceLocator()->get('MClients');
  $res = $mc->getTest();
  $form = new Search();
  return new ViewModel(array('TPR' => $res['TPR'], 'form' => $form));
   */
  return new ViewModel();
 }

 public function testAction() {

  return new ViewModel();
 }

 public function searchAction() {

  return new ViewModel();
 }

 public function addAction() {

  return new ViewModel();
 }

}
