<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
//use lib\test;

class IndexController extends AbstractActionController
{
    public function indexAction(){
//        echo "aaaaaaaaaaa";exit;
           
       try{ 
       $mdbc=$this->getServiceLocator()->get('DbCommon');
 
       //print_r($mdbc->getCountContacts());
       //$dt=$mdbc->getDocumentTemplate();
       $dt=$mdbc->getFiletable();
       
       /*
       foreach($dt as $key=>$req){
         //echo $key;
         $TBData = stream_get_contents($req['TEMPLATEBODY']);
         $res=file_put_contents('/home/uukrul/php/zftsu/data/documentemplate/'.$req['TEMPLATEFILENAME'], $TBData);
         
       }
       */
       
       } catch (Exception $e){
           echo 'error'.$e->ErrorMsg();
           
       }
       //exit;
        return new ViewModel();
    }
    
    function testAction(){
      return new ViewModel();
    }
}
