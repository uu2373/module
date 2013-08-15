<?php

return array(
 
    'controllers' => array(
        'invokables' => array(
            //'User\Controller\User' => 'User\Controller\UserController',
            // 'User\Controller\Success' => 'SanAuth\Controller\SuccessController',
            //'User\Controller\Console' => 'User\Controller\ConsoleController'
        ),
    ),
    'service_manager' => array(
        'factories' => array(
            'Auth\Config'=> 'Auth\Service\ConfigServiceFactory',
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
    
);
