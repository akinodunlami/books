<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

return array(
    'console' => array(
        'router' => array(
            'routes' => array(
                'books-createbook' => array(
                    'type'      => 'simple',
                    'options'   => array(
                        'route' => 'createbook [--verbose|-v] --username= --password=',
                        'defaults'  => array(
                            'controller'    => 'UserMgr\Controller\Console',
                            'action'        => 'create-user'
                        ),
                    ),
                ), 
                'user-reset-password' => array(
                    'type'      => 'simple',
                    'options'   => array(
                        'route' => 'user resetpassword [--verbose|-v] --username=',
                        'defaults'  => array(
                            'controller'    => 'UserMgr\Controller\Console',
                            'action'        => 'reset-password'
                        ),
                    ),
                ),                 
            )
        )
    ),
    'controllers' => array(
        'invokables' => array(
            'Books\Controller\Console'    => 'UserMgr\Controller\ConsoleController', 
            'Books\Controller\Books'      => 'Books\Controller\BooksController',
        )
    ),
    'router' => array(
        'routes' => array(
            
        )
    ),
    'service_manager' => array(
        'factories' => array(
            'UserManager' => 'UserMgr\Factory\UserManagerFactory'
        ),
        'services' => array(
            'entity_paths' => array(
                __DIR__ . '/../Entities',
            )
        )
    ),
    'view_manager' => array(
        'template_map' => array(),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),    
);
