<?php
/**
 * File for Event Class
 *
 * @category  User
 * @package   User_Event
 * @author    Marco Neumann <webcoder_at_binware_dot_org>
 * @copyright Copyright (c) 2011, Marco Neumann
 * @license   http://binware.org/license/index/type:new-bsd New BSD License
 */

/**
 * @namespace
 */
namespace User\Event;

/**
 * @uses Zend\Mvc\MvcEvent
 * @uses User\Controller\Plugin\UserAuthentication
 * @uses User\Acl\Acl
 */
use Zend\Mvc\MvcEvent as MvcEvent,
    User\Controller\Plugin\UserAuthentication as AuthPlugin,
    User\Acl\Acl as AclClass;

/**
 * Authentication Event Handler Class
 *
 * This Event Handles Authentication
 *
 * @category  User
 * @package   User_Event
 * @copyright Copyright (c) 2011, Marco Neumann
 * @license   http://binware.org/license/index/type:new-bsd New BSD License
 */
class Authentication
{
    /**
     * @var AuthPlugin
     */
    protected $_userAuth = null;

    /**
     * @var AclClass
     */
    protected $_aclClass = null;

    /**
     * preDispatch Event Handler
     *
     * @param \Zend\Mvc\MvcEvent $event
     * @throws \Exception
     */
    public function preDispatch(MvcEvent $event)
    {

       $app = $event->getApplication();

		// Get SM
		  $sm = $app->getServiceManager();

        //@todo - Should we really use here and Controller Plugin?
        $userAuth = $this->getUserAuthenticationPlugin();
        //$acl = $this->getAclClass();
        $acl = $sm->get('User\Acl\Acl');
        $this->role = $sm->get('User\Acl\Acl');
        //$role = AclClass::DEFAULT_ROLE;

        if ($userAuth->hasIdentity()) {
            $user = $userAuth->getIdentity();
            $role = 'member'; //@todo - Get role from user!
        }


        $routeMatch = $event->getRouteMatch();
	      $controller = $routeMatch->getParam('modules');
        $controller = $routeMatch->getParam('controller');
        $action     = $routeMatch->getParam('action');

        if (!$acl->hasResource($controller)) {
            throw new \Exception('ACL:Resource ' . $controller . ' not defined');
        }

        if (!$acl->isAllowed($role, $controller, $action)) {
            $url = $event->getRouter()->assemble(array(), array('name' => 'login'));
            $response = $event->getResponse();
            $response->getHeaders()->addHeaders(array(array('Location' => $url)));
            //$response->headers()->addHeaderLine('Location', $url);
            $response->setStatusCode(302);
            $response->sendHeaders();
            exit;
        }
    }

    /**
     * Sets Authentication Plugin
     *
     * @param \User\Controller\Plugin\UserAuthentication $userAuthenticationPlugin
     * @return Authentication
     */
    public function setUserAuthenticationPlugin(AuthPlugin $userAuthenticationPlugin)
    {
        $this->_userAuth = $userAuthenticationPlugin;

        return $this;
    }

    /**
     * Gets Authentication Plugin
     *
     * @return \User\Controller\Plugin\UserAuthentication
     */
    public function getUserAuthenticationPlugin()
    {
        if ($this->_userAuth === null) {
            $this->_userAuth = new AuthPlugin();
        }

        return $this->_userAuth;
    }

    /**
     * Sets ACL Class
     *
     * @param \User\Acl\Acl $aclClass
     * @return Authentication
     */
    public function setAclClass(AclClass $aclClass)
    {
        $this->_aclClass = $aclClass;

        return $this;
    }

    /**
     * Gets ACL Class
     *
     * @return \User\Acl\Acl
     */
    public function getAclClass()
    {
        if ($this->_aclClass === null) {
            $this->_aclClass = new AclClass(array());
         //$this->_aclClass = $this->getServiceLocator()->get('UAcl');
        }

        return $this->_aclClass;
    }
}