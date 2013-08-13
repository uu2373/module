<?php
namespace User\Service;
/**
 * Description of Authorize
 *
 * @author AShvager
 */
use Zend\ServiceManager\ServiceLocatorInterface;
class Authorize
{
    /**
     * {@inheritDoc}
     *
     * @return \BjyAuthorize\Service\Authorize
     */
     
    
    private $serviceLocator;
    private $config;

    public function __construct(array $config, ServiceLocatorInterface $serviceLocator)
    {
        $this->config         = $config;
        $this->serviceLocator = $serviceLocator;
        // Загрузить ACL
        //
        $this->setIdentityProvider($this->serviceLocator->get('User\Provider\Identity\ProviderInterface'));
        
    }

    public function getIdentity()
    {
        return 'user-identity';
    }
    
    public function setIdentityProvider(){
        return;
    }

    
    
}
