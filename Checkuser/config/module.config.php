<?php

return array(
  //////////////////////////////////////////////////////////////////////
  'controllers' => array(
    'invokables' => array(
      'Checkuser\Controller\Checkuser' => 'Checkuser\Controller\CheckuserController',
      // 'User\Controller\Success' => 'SanAuth\Controller\SuccessController',
      'Checkuser\Controller\Console' => 'Checkuser\Controller\ConsoleController'
    ),
  ),
  'router' => array(
    'routes' => array(
      'checkuser' => array(
        'type' => 'Zend\Mvc\Router\Http\Literal',
        'options' => array(
          'route' => '/checkuser',
          'defaults' => array(
            'controller' => 'Checkuser\Controller\Checkuser',
            'action' => 'checkuser',
          )
        ),

        'may_terminate' => true,
        'child_routes' => array(
          'checkuser' => array(
            'type' => 'Literal',
            'options' => array(
              'route' => '/checkuser',
              'defaults' => array(
                'controller' => 'Checkuser\Controller\Checkuser',
                'action' => 'checkuser',
              ),
            ),
          ),
          )
      )
    )
  ),
  'console' => array(
    'router' => array(
      'routes' => array(
        'user-parameters' => array(
          'options' => array(
            'route' => 'Checkuser [--version=] [--pass=] [--config=] [-d]',
            'defaults' => array(
              'controller' => 'Checkuser\Controller\Console',
              'action' => 'getParam'
            )
          )
        )
      )
    )
  ),
  'view_manager' => array(
    'template_path_stack' => array(
      'checkuser' => __DIR__ . '/../view',
    ),
  ),
);
