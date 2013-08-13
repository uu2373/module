<?php
namespace Clients\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Clients\Form\SearchForm;
use Clients\Entity\Search as Search;
use CustomLib as cl;

class IndexController extends AbstractActionController {

 public function indexAction() {
  //$t=new cl\Test();
  //$t->Test2();
  
  //echo "ss";
  /*$mc = $this->getServiceLocator()->get('MClients');
  $res = $mc->getTest();
  $form = new Search();
  return new ViewModel(array('TPR' => $res['TPR'], 'form' => $form));*/
  return new ViewModel();
 }

 public function testAction() {

  return new ViewModel();
 }

 public function searchAction() {
     $form = new SearchForm();
     $search = new Search();
     $form->bind($search);

     if ($this->request->isPost()) {
         $form->setData($this->request->getPost());

         if ($form->isValid()) {
             var_dump($search);
         }
     }

     return array(
         'form' => $form
     );
  /*$mc = $this->getServiceLocator()->get('MClients');*/
  return new ViewModel();
 }

 public function addAction() {

  return new ViewModel();
 }
 public function qsearchAction() {

  return new ViewModel();
 }


}
