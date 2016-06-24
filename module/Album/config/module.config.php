<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'Album\Controller\Album' => 'Album\Controller\AlbumController'
        ),
    ),
        
    'view_manager' => array(
        'doctype'                  => 'HTML5',
        'display_not_found_reason' => true,
        'not_found_template'       => 'error/404',
            
        'display_exceptions'       => true,
        'exception_template'       => 'error/index',
        
        'template_path_stack' => array(__DIR__ . '/../view',),
        
        'template_map' => array(
            'layout/album' => PATH_TEMPLATE . '/album/layout.phtml',
            'layout/error' => PATH_TEMPLATE . '/error/layout.phtml',
            'error/404' => PATH_TEMPLATE . '/error/404.phtml',
            'error/index' => PATH_TEMPLATE . '/error/index.phtml',
        ),
        'default_template_suffix'   => 'phtml',
        'layout'                    => 'layout/album'
        ),

    'router' => array(
        'routes' => array(
            'home' => array(
                'type'    => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/',
                    'defaults' => array(
                        'controller'    => 'Admin\Controller\Index',
                        'action'        => 'index',
                    ),
                ),
            ),
        ),
    ),
    'album' => array(
    'type'    => 'Literal',
    'options' => array(
        'route'    => '/admin',
        'defaults' => array(
                '__NAMESPACE__' => 'Album\Controller',
                'controller'    => 'Album',
                'action'        => 'index',
        ),
    ),
    'may_terminate' => true,
    'child_routes' => array(
        'default' => array(
            'type'    => 'Segment',
            'options' => array(
                'route'    => '/[:controller[/:action]][/]',
                'constraints' => array(
                    'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                    'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                ),
                'defaults' => array(),
            ),
        ),
    ),
),



);

