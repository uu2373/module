<?php

return array(
 
    'controllers' => array(
        'invokables' => array(
            'User\Controller\User' => 'User\Controller\UserController',
            // 'User\Controller\Success' => 'SanAuth\Controller\SuccessController',
            'User\Controller\Console' => 'User\Controller\ConsoleController'
        ),
    ),
    'service_manager' => array(
        'factories' => array(
            'User\Config'=> 'User\Service\ConfigServiceFactory',
            //'User\ControllerGuard' => 'User\Service\ControllerGuardServiceFactory',
            'User\Guard\Controller' =>   'User\Service\ControllerGuardServiceFactory',
            'User\Service\Authorize'=>   'User\Service\AuthorizeFactory',
            'User\Service\Provider'=>    'User\Service\IdentityProviderServiceFactory',
            
            'User\Provider\Identity\ProviderInterface'=>'User\Service\ZfcUserZendDbIdentityProviderServiceFactory',
            
            
            'User\Acl\Acl' => 'User\Acl\Acl',
        )
    ),
    'router' => array(
        'routes' => array(
            'login' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route' => '/login',
                    'defaults' => array(
                        'module' => 'user',
                        'controller' => 'User\Controller\User',
                        'action' => 'login',
                    )
                ),
            /*
              'may_terminate' => true,
              'child_routes' => array(
              'default' => array(
              'type'    => 'Segment',
              'options' => array(
              'route'    => '/[:controller[/:action]]',
              'constraints' => array(
              'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
              'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
              ),
              'defaults' => array(
              ),
              ),
              ),
              )
             */
            )
        )
    ),
    'console' => array(
        'router' => array(
            'routes' => array(
                'user-parameters' => array(
                    'options' => array(
                        'route' => 'user [--version=] [--pass=] [--config=] [-d]',
                        'defaults' => array(
                            'controller' => 'User\Controller\Console',
                            'action' => 'getParam'
                        )
                    )
                )
            )
        )
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'User' => __DIR__ . '/../view',
        ),
    ),
    
//    'di' => array(
//        'instance' => array(
////      'alias' => array(
////        'user' => 'User\Controller\UserController'
////      ),
//        /*      'user' => array(
//          'parameters' => array(
//          'broker' => 'Zend\Mvc\Controller\PluginBroker'
//          )
//          ),
//         */
////      'User\Event\Authentication' => array(
////        'parameters' => array(
////          'userAuthenticationPlugin' => 'User\Controller\Plugin\UserAuthentication',
////          'aclClass' => 'User\Acl\Acl'
////        )
////      ),
////      'User\Acl\Acl' => array(
////        'parameters' => array(
////          'config' => include __DIR__ . '/acl.config.php'
////        )
////      ),
//        /*      'User\Controller\Plugin\UserAuthentication' => array(
//          'parameters' => array(
//          //'authAdapter' => 'Zend\Authentication\Adapter\DbTable'
//          // 'authAdapter' => 'Zend\Authentication\Adapter\AdapterInterface'
//          'authAdapter' => 'Zend\Db\Adapter\AdapterServiceFactory'
//          )
//          ), */
//        /*      'Zend\Authentication\Adapter\DbTable' => array(
//          'parameters' => array(
//          //'zendDb' => 'Zend\Db\Adapter\Adapter',
//          'zendDb' => 'Zend\Db\Adapter\AdapterInterface',
//          'tableName' => 'contact',
//          'identityColumn' => 'email',
//          'credentialColumn' => 'password',
//          'credentialTreatment' => 'SHA1(CONCAT(?, "secretKey"))'
//          )),
//          'Zend\Db\Adapter\Adapter' => array(
//          'parameters' => array(
//          'driver' => 'Zend\Db\Adapter\Driver\Pdo\Pdo',
//          ),
//          ),
//          'Zend\Db\Adapter\Driver\Pdo\Pdo' => array(
//          'parameters' => array(
//          'connection' => 'Zend\Db\Adapter\Driver\Pdo\Connection',
//          ),
//          ),
//          'Zend\Db\Adapter\Driver\Pdo\Connection' => array(
//          'parameters' => array(
//          // 'connectionInfo' => array(
//          'connectionParameters' => array(
//          'dsn' => "sqlite:dbname=OSS;host=10.1.2.250",
//          'username' => 'dev',
//          'password' => 'ljk,bntcm!',
//          //    'driver_options' => array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''),
//          ),
//          ),
//          ), */
//        /*                    'zendDb' => 'Zend\Db\Adapter\Mysqli',
//          'tableName' => 'users',
//          'identityColumn' => 'email',
//          'credentialColumn' => 'password',
//          'credentialTreatment' => 'SHA1(CONCAT(?, "secretKey"))'
//
//          )
//          ),
//          'Zend\Db\Adapter\Mysqli' => array(
//          'parameters' => array(
//          'config' => array(
//          'host' => 'localhost',
//          'username' => 'username',
//          'password' => 'password',
//          'dbname' => 'dbname',
//          'charset' => 'utf-8'
//          )
//          )
//          ),
//         */
//        /*      'Zend\Mvc\Controller\PluginLoader' => array(
//          'parameters' => array(
//          'map' => array(
//          'userAuthentication' => 'User\Controller\Plugin\UserAuthentication'
//          )
//          )
//          ), */
//        /*      'Zend\View\PhpRenderer' => array(
//          'parameters' => array(
//          'options' => array(
//          'script_paths' => array(
//          'user' => __DIR__ . '/../views'
//          )
//          )
//          )
//
//          ) */
//        )
//    ),
    //////////////////////////////////////////////////////////////////////    
    
);
