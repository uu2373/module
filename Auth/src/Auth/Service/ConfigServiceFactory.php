<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Auth\Service;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ConfigServiceFactory implements FactoryInterface{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $config = $serviceLocator->get('Config');
        return $config['acl'];    
    }
}    
?>
