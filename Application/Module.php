<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
//use Zend\Navigation\Service;


class Module
{
    public function onBootstrap(MvcEvent $e)
    {
        //$e->getApplication()->getServiceManager()->get('translator');
        //$eventManager        = $e->getApplication()->getEventManager();
        //$moduleRouteListener = new ModuleRouteListener();
        //$moduleRouteListener->attach($eventManager);
    }


  public function getConfig() {
      return array_merge(
              include __DIR__ . '/config/module.config.php',
              include __DIR__ . '/config/nav.config.php'
              ); 
  }



    public function getAutoloaderConfig(){
        return array(
           'Zend\Loader\ClassMapAutoloader' => array(
                           __DIR__ . '/autoload_classmap.php',
            ),

            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getServiceConfig() {
     return array(
       'factories' => array(
         'Navigation' => 'Zend\Navigation\Service\DefaultNavigationFactory'

         )
     );
    }



}
