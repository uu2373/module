<?php

return array(
  'controllers' => array(
    'invokables' => array(
      'Clients\Controller\Index' => 'Clients\Controller\IndexController',
    ),
    'alias' => array(
    )
  ),
  /*   'router' => array(
    'routes' => array(
    'clients' => array(
    'type' => 'literal',
    'options' =>array(
    'route' => '/clients',
    'defaults'=>array(
    '__NAMESPACE__' => 'Clients\Controller',
    'controller'=>'Index',
    'action' => 'index',
    //'id'=>0
    )
    ),
    'may_terminate'=>true,
    'child_routes'=>array(
    'default'=>array(
    'type'=>'segment',
    'options'=>array(
    //'route'=> '/[:controller[/:action[/:id]]]',
    //'route'=> '/[:action]',
    'route'=> '/clients[:action/[:id]]',
    //'route'=> '/clients[/:action[/:id]]',
    'constraints'=>array(
    //'controller'=>'[a-zA-Z0-9_-]+',
    //'controller'=>'/clients',
    //'controller'=>'index',
    'action'=>'[a-zA-Z0-9_-]+',
    'id'=>'[0-9]+'
    ),
    'defaults'=>array(
    //'action'=>'index'
    )
    )
    )
   *
   */
//		   )
//    'router' => array(
//	'routes' => array(
//	    'clients' => array(
//		'type' => 'Segment',
//		'options' => array(
//		    'route' => '/[:controller]/[:action]',
//		    'constraints' => array(
//			'__NAMESPACE_','Clients\Controller',
//			'controller' => '[a-zA-Z0-9_-]+',
//			'action' => '[a-zA-Z0-9_-]+',
//		    // 'id' => '[0-9]+',
//		    ),
//		    'defaults' => array(
//			'controller' => 'Clients\Controller\Index',
////			//'action' => 'index',
//		    ),
//),
//		'may_terminate' => true,
////		'child_routes' => array(
////		    'search' => array(
////			'type' => 'segment',
////			'options' => array(
////			    'route' => '/search',
////			    'constraints' => array(
////				'action' => '[a-zA-Z0-9_-]+',
////				'id' => '[0-9]+'
////			    ),
////			    'defaults' => array(
////			    )
////			)
////		    ),
////		    'adqd' => array(
////			'type' => 'literal',
////			'options' => array(
////			    'route' => '/add',
////
////			    'defaults' => array(
////			    )
////			)
////		    )
////		    )
////
//
//
//	    ),
//	),
//    ),
  // ),
  'router' => array(
    'routes' => array(
      'clients' => array(
        'type' => 'Literal',
        'priority' => 1000,
        'options' => array(
          'route' => '/clients',
          'defaults' => array(
            'module' => "clients",
            'controller' => 'Clients\Controller\Index',
            'action' => 'index',
          ),
        ),
        'may_terminate' => true,
        'child_routes' => array(
          'search' => array(
            'type' => 'Literal',
            'options' => array(
              'route' => '/search',
              'defaults' => array(
                'controller' => 'Clients\Controller\Index',
                'action' => 'search',
              ),
            ),
          ),
          'add' => array(
            'type' => 'Literal',
            'options' => array(
              'route' => '/add',
              'defaults' => array(
                'controller' => 'Clients\Controller\Index',
                'action' => 'add',
              ),
            ),
          ),
        ),
      )
    )
  ),
  'view_manager' => array(
    'template_path_stack' => array(
      __DIR__ . '/../view',
    ),
  ),
);
