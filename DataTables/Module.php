<?php
namespace DataTables;

use Zend\Loader\PluginClassLoader, 
    Zend\Module\Manager;
    //,Zend\Module\Consumer\AutoloaderProvider;

class Module // implements AutoloaderProvider
{
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php',
            )
        );
    }
    
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }
}