<?php
/**
 * User Module (https://github.com/bjyoungblood/BjyAuthorize)
 *
 * @link https://github.com/bjyoungblood/BjyAuthorize for the canonical source repository
 * @license http://framework.zend.com/license/new-bsd New BSD License
 */

namespace User\Service;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Base factory responsible of instantiating providers
 *
 * @author Marco Pivetta <ocramius@gmail.com>
 */
abstract class BaseProvidersServiceFactory implements FactoryInterface
{
    const PROVIDER_SETTING = 'providers';

    /**
     * {@inheritDoc}
     *
     * @return array
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        //$config    = $serviceLocator->get('BjyAuthorize\Config');
        $providers = array();
        return $providers[] = $serviceLocator->get('User\Guard\Controller');


        //return $providers[] = new User\Guard\Controller($providerConfig, $serviceLocator);
            if ($serviceLocator->has('User\Guard\Controller')) {
                $providers[] = $serviceLocator->get('User\Guard\Controller');
            } else {
                $providers[] = new User($providerConfig, $serviceLocator);
            }


        foreach ($config[static::PROVIDER_SETTING] as $providerName => $providerConfig) {
            if ($serviceLocator->has($providerName)) {
                $providers[] = $serviceLocator->get($providerName);
            } else {
                $providers[] = new User($providerConfig, $serviceLocator);
            }
        }

        return $providers;
    }
}
