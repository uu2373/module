<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
return array(
    'user'=>array(
        'default_role'=>'guest',
        'identity_provider'=>'User\Provider\Identity\ZfcUserZendDb',
        'guard'=>array('controller'),
        'controllerguard'=>array(
            array('controller' => 'index', 'action' => 'index', 'roles' => array('guest','user')),
        ),
    )
);
?>
