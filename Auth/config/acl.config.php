<?php
return array(
  'acl' => array(
    'roles' => array(
      'guest' => null,
      'member' => 'guest'
    ),
    'resources' => array(
      'allow' => array(
        //'user' => array(
        'User\Controller\Console' => array(
          'all' => 'guest'
        ),
        'User\Controller\User' => array(
          'login' => 'guest',
          'all' => 'member'
        ),
        'Clients\Controller\Index' => array(
          //'index' => 'guest',
          'all' => 'member',
          //'add' => 'guest'
        ),
        'Debitors\Controller\Index' => array(
          //'search'=>'guest'
          'all' => 'guest'
        ),
        'Checkuser\Controller\Checkuser'=>array(
          'all'=>'guest'
        )
      )
    )
  )
    //
);