<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonModule for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Clients;

use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\Mvc\ModuleRouteListener;

class Module implements AutoloaderProviderInterface
{
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(__DIR__ . '/autoload_classmap.php',),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
		    // if we're in a namespace deeper than one level we need to fix the \ in the path
//                    __NAMESPACE__ => __DIR__ . '/src/' . str_replace('\\', '/' , __NAMESPACE__),
                      __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function onBootstrap($e)
    {
        // You may not need to do this if you're doing it elsewhere in your
        // application
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
    }


    public function getViewHelperConfig()
    {
        return array(
            'invokables' => array(
            //    'NewsTime'        => 'News\View\Helper\TTime',
            ),
        );
    }



   public function getServiceConfig(){
     return array(
/*       'initializers' => array(         
           function ($instance, $sm) {
              if ($instance instanceof \Zend\Db\Adapter\AdapterAwareInterface) {
                 //$instance->setDbAdapter($sm->get('ZDBA'));
                 
              }
           }
       ),*/
       'factories' => array(
         // 'BlankDB'      => function($sm) { return $bdb= new Model\BlankDB(); },
         // 'ModelUtils'   => function($sm) { return $mu = new Model\ModelUtils();},
          'MClients'    => function($sm) { 
             $mc=new Model\ModelClients();
             $mc->setDbAdapter($sm->get('ZDBA'));
             return $mc;
            }
        ),
        'invokables'=>array(
        //   'Application\Model\ModelNews'=>'ModelNews'
         )
     );
   
   }

}
