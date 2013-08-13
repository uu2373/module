<?php
/**
 * File for CheckUser Controller Class
 *
 * @category  CheckUser
 * @package   CheckUser_Controller
 * @author    Shvager Alexander <shvager_at_mail_dot_ru>
 * @copyright Copyright (c) 2013, Shvager Alexander
 * @license   http://binware.org/license/index/type:new-bsd New BSD License
 */

namespace Checkuser\Controller;

/**
 * @uses Zend\Mvc\Controller\ActionController
 * @uses User\Form\Login
 */
//use Zend\Mvc\Controller\ActionController;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\Form\Annotation\AnnotationBuilder;
use Checkuser\Form\Checkuser as CheckuserForm;
use Checkuser\Entity\User as EUser;

/**
 * User Controller Class
 *
 * User Controller
 *
 * @category  User
 * @package   User_Controller
 * @copyright Copyright (c) 2011, Marco Neumann
 * @license   http://binware.org/license/index/type:new-bsd New BSD License
 */
class CheckuserController extends AbstractActionController {

 private $form;

 public function getAuthService() {
  if (!$this->authservice) {
   $this->authservice = $this->getServiceLocator()->get('AuthService');
  }

  return $this->authservice;
 }
public function exchangeArray($data)
    {
        $this->login     = (isset($data['login']))     ? $data['login']     : null;
        $this->status = (isset($data['status'])) ? $data['status'] : null;

    }

 /**
  * Index Action
  */
 public function checkuserAction() {
  $form = $this->getForm();
  $entityuser=new EUser();
  $form->bind($entityuser);


  $request=$this->getRequest();
  $form->setData($request->getPost());
  if ($request->isPost()){

   if ($form->isValid()){
    //$this->messages=array('ssssssssssss');
    //$this->exchangeArray($form->getData());
    $login=$request->getPost('login');
    $form->get('status')->setAttribute('value','включен');

    //$form->get('submit')->setAttribute('value','Включить');
    $this->flashMessenger()->addMessage('Логин:'.$login);
    //$form->bind($form->get());
     //var_dump($entityuser);
    return $this->redirect()->toRoute('checkuser');
   }

  }


  return array(
    'form' => $form,
    'messages' => $this->flashmessenger()->getMessages()
  );
 }

 public function getForm() {
  if (!$this->form) {
   $checkuser = new CheckuserForm();
   $builder = new AnnotationBuilder();
   $this->form = $builder->createForm($checkuser);
  }

  return $this->form;
 }

 /**
  * Login Action
  *
  * @return array
  */
 /*
   public function loginAction() {
   //$form = new LoginForm();
   $form = $this->getForm();
   $request = $this->getRequest();

   if ($request->isPost()
   //&& $form->isValid($request->getPost()->toArray())
   ) {
   //$uAuth = $this->getLocator()->get('User\Controller\Plugin\UserAuthentication'); //@todo - We must use PluginLoader $this->userAuthentication()!!
   $uAuth = $this->getServiceLocator()->get('User\Controller\Plugin\UserAuthentication');
   $authAdapter = $uAuth->getAuthAdapter();

   $authAdapter->setIdentity($form->getValue('username'));
   $authAdapter->setCredential($form->getValue('password'));

   \Zend\Debug::dump($uAuth->getAuthService()->authenticate($authAdapter));
   }

   return array('loginForm' => $form);
   }
  */

 public function updateAction() {
  $request = $this->getRequest();
  if ($request->isPost()) {
   $form->setData($request->getPost());
   if ($form->isValid()) {

   }
  }


  $form = $this->getForm();

  return array(
    'form' => $form,
    'messages' => $this->flashmessenger()->getMessages()
  );
 }



}
