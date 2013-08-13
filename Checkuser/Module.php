<?php

namespace Checkuser;

use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\Console\Adapter\AdapterInterface as Console;


use Zend\View\HelperPluginManager;
use Zend\Permissions\Acl\Acl;
use Zend\Permissions\Acl\Role\GenericRole;
use Zend\Permissions\Acl\Resource\GenericResource;
use Zend\Mvc\MvcEvent;
use Zend\ModuleManager\ModuleManager;
use Zend\EventManager\EventInterface as Event;
use Zend\EventManager\EventManagerInterface;


class Module implements AutoloaderProviderInterface {

 public function getAutoloaderConfig() {
  return array(
    'Zend\Loader\ClassMapAutoloader' => array(__DIR__ . '/autoload_classmap.php',),
    'Zend\Loader\StandardAutoloader' => array('namespaces' => array(__NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,),),
  );
 }


 public function init(ModuleManager $moduleManager)
    {
        // Remember to keep the init() method as lightweight as possible
  //      $events = $moduleManager->getEventManager();
//        $events->attach('loadModules.post', array($this, 'navoff'));
    }

 public function navoff($e){

  $nav=$e->getApplication()->getServiceManager()->get('Navigation');
  //$nav->removePages();
 }

 public function onBootstrap(MvcEvent $e){
  //$e->getApplication()->getServiceManager()->attach(MvcEvent::EVENT_DISPATCH, array($this, 'navoff'), 100);
  $acl = new Acl();
  $acl->addRole(new GenericRole('member'));
  $acl->addRole(new GenericRole('admin'));
  $acl->addResource(new GenericResource('mvc:admin'));
  $acl->addResource(new GenericResource('mvc:community.account'));
  $acl->allow('member', 'mvc:community.account');
  $acl->allow('admin', null);


  $nav=$e->getApplication()->getServiceManager()->get('Navigation');
  //$nav->removePages();
  //$e2=$e->getApplication()->getServiceManager()->get('View');
  //
  //$e2->navigation('navigation')->setAcl($acl)->setRole('member');
  \Zend\View\Helper\Navigation\AbstractHelper::setDefaultAcl($acl);
  \Zend\View\Helper\Navigation\AbstractHelper::setDefaultRole('member');
  //print_r($ee);exit;
 }

 public function getConfig() {
  return include __DIR__ . '/config/module.config.php';
 }

 public function getViewHelperConfig() {
  return array(
    'invokables' => array(
    //    'NewsTime'        => 'News\View\Helper\TTime',
    ),
'factories' => array(
 // This will overwrite the native navigation helper
 // 'navigation' => function(HelperPluginManager $pm) {
 /* 'navigation' => function(ServiceManager $pm) {
 // Setup ACL:

   //var_dump($pm);exit
 $acl = new Acl();
 $acl->addRole(new GenericRole('member'));
 $acl->addRole(new GenericRole('admin'));
 $acl->addResource(new GenericResource('mvc:admin'));
 $acl->addResource(new GenericResource('mvc:community.account'));
 $acl->allow('member', 'mvc:community.account');
 $acl->allow('admin', null);
//var_dump($pm);exit;
 // Get an instance of the proxy helper
 $navigation = $pm->get('Navigation');
 //$app          = $pm->getTarget();
        //$locator      = $pm->getServiceManager();
//        $view         = $pm->get('Zend\View\View');
//        var_dump($view);exit;

 //$pm->navigation()->setAcl($acl)->setRole('member');
 //var_dump($navigation);exit;
 // Store ACL and role in the proxy helper:
 $navigation->setAcl($acl)->setRole('member');

 // Return the new navigation helper instance
 return $navigation;
 }*/
 )
  );
 }

 public function getServiceConfig() {
  return array(
    'invokables' => array(
    ),
    'initializers' =>array(
    ),
    'factories'=>array(
//       'navigation' => function (HelperPluginManager $pm) {
//                        $factory = new CustomNavigationFactory();
//                        $factory->setName('default');
//                        return $factory->createService($sm);
//                },



    )
  );
 }

 public function getConsoleBanner(Console $console) {
  return 'CheckUser Module';
 }

 public function getConsoleUsage(Console $console) {
  //description command
  return array(
    'checkuser --vesion' => 'Get current version',
    'checkuser -d' => 'debug session',
  );
 }

}
