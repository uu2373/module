<?php

return array(
    'controllers' => array(
        'invokables' => array(
            'Debitors\Controller\Index' => 'Debitors\Controller\IndexController',
        ),
    ),
    'router' => array(
        'routes' => array(
            'debitors' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/debitors[/:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Debitors\Controller\Index',
                        'action' => 'index',
                    ),
                ),
            ),
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
);
