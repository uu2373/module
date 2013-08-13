<?php

/**
 * File for User Controller Class
 *
 * @category  User
 * @package   User_Controller
 * @author    Marco Neumann <webcoder_at_binware_dot_org>
 * @copyright Copyright (c) 2011, Marco Neumann
 * @license   http://binware.org/license/index/type:new-bsd New BSD License
 */
/**
 * @namespace
 */

namespace User\Controller;

/**
 * @uses Zend\Mvc\Controller\ActionController
 * @uses User\Form\Login
 */
//use Zend\Mvc\Controller\ActionController;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\Form\Annotation\AnnotationBuilder;
use User\Form\Login as LoginForm;

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
class UserController extends AbstractActionController {
private $authservice;
private $form;

 public function getAuthService() {
  if (!$this->authservice) {
   $this->authservice = $this->getServiceLocator()->get('AuthService');
  }

  return $this->authservice;
 }

 /**
  * Index Action
  */
 public function indexAction() {
  //@todo - Implement indexAction
 }

 public function getForm() {
  if (!$this->form) {
   $login = new LoginForm();
   $builder = new AnnotationBuilder();
   $this->form = $builder->createForm($login);
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

     public function loginAction()
    {
        //  echo "ssssssssss";exit;
        //if already login, redirect to success page
        if ($this->getAuthService()->hasIdentity()){
            return $this->redirect()->toRoute('success');
        }

        $form       = $this->getForm();

        return array(
            'form'      => $form,
            'messages'  => $this->flashmessenger()->getMessages()
        );
    }

    public function authenticateAction()
    {
        $form       = $this->getForm();
        $redirect = 'login';

        $request = $this->getRequest();
        if ($request->isPost()){
            $form->setData($request->getPost());
            if ($form->isValid()){
                //check authentication...
                $this->getAuthService()->getAdapter()
                                       ->setIdentity($request->getPost('username'))
                                       ->setCredential($request->getPost('password'));

                $result = $this->getAuthService()->authenticate();
                foreach($result->getMessages() as $message)
                {
                    //save message temporary into flashmessenger
                    $this->flashmessenger()->addMessage($message);
                }

                if ($result->isValid()) {
                    $redirect = 'success';
                    //check if it has rememberMe :
                    if ($request->getPost('rememberme') == 1 ) {
                        $this->getSessionStorage()
                             ->setRememberMe(1);
                        //set storage again
                        $this->getAuthService()->setStorage($this->getSessionStorage());
                    }
                    $this->getAuthService()->setStorage($this->getSessionStorage());
                    $this->getAuthService()->getStorage()->write($request->getPost('username'));
                }
            }
        }

        return $this->redirect()->toRoute($redirect);
    }


 /**
  * Logout Action
  */
 public function logoutAction() {
  $this->getLocator()->get('User\Controller\Plugin\UserAuthentication')->clearIdentity(); //@todo - We must use PluginLoader $this->userAuthentication()!!
 }

}
