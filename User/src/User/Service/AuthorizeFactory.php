<?php
namespace User\Service;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;


/**
 *  Фабрика для авторизации
 *
 * @author Shvager Alexander <shvager@mail.ru>
 */
class AuthorizeFactory implements FactoryInterface
{
    /**
     * {@inheritDoc}
     *
     * @return \User\Service\Authorize
     * ветка user
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return new Authorize($serviceLocator->get('User\Config'), $serviceLocator);
         
    }
}
