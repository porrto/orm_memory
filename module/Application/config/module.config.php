<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application;

return array(
    'router' => array(
        'routes' => array(
            'home' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Index',
                        'action'     => 'index',
                    ),
                ),
            ),
            'user'        =>
                [
                    'type'          => 'Literal',
                    'options'       =>
                        [
                            'route'    => '/user',
                            'defaults' =>
                                [
                                    '__NAMESPACE__' => 'Application\Controller',
                                    'controller'    => 'User'
                                ]
                        ],
                    'may_terminate' => false,
                    'child_routes'  =>
                        [
                            'add'  =>
                                [
                                    'type'    => 'Literal',
                                    'options' =>
                                        [
                                            'route'    => '/add',
                                            'defaults' => ['action' => 'add-or-edit']
                                        ]
                                ],
                            'edit'  =>
                                [
                                    'type'    => 'Segment',
                                    'options' =>
                                        [
                                            'route'    => '/edit[/:user_id]',
                                            'defaults' => ['action' => 'add-or-edit']
                                        ],
                                    'constraints' => array(
                                        'user_id' => '[0-9]+'
                                    ),
                                ],
                            'list'  =>
                                [
                                    'type'    => 'Literal',
                                    'options' =>
                                        [
                                            'route'    => '/list',
                                            'defaults' => ['action' => 'list']
                                        ]
                                ],
                            'delete'  =>
                                [
                                    'type'    => 'Segment',
                                    'options' =>
                                        [
                                            'route'    => '/delete(/:user_id]',
                                            'defaults' => ['action' => 'delete']
                                        ],
                                    'constraints' => array(
                                        'user_id' => '[0-9]+'
                                    ),
                                ],
                        ]
                ],
            'ski-level'        =>
                [
                    'type'          => 'Literal',
                    'options'       =>
                        [
                            'route'    => '/ski-level',
                            'defaults' =>
                                [
                                    '__NAMESPACE__' => 'Application\Controller',
                                    'controller'    => 'SkiLevel'
                                ]
                        ],
                    'may_terminate' => false,
                    'child_routes'  =>
                        [
                            'add'  =>
                                [
                                    'type'    => 'Literal',
                                    'options' =>
                                        [
                                            'route'    => '/add',
                                            'defaults' => ['action' => 'add-or-edit']
                                        ]
                                ],
                            'edit'  =>
                                [
                                    'type'    => 'Segment',
                                    'options' =>
                                        [
                                            'route'    => '/edit[/:ski-level_id]',
                                            'defaults' => ['action' => 'add-or-edit']
                                        ],
                                    'constraints' => array(
                                        'ski-level_id' => '[0-9]+'
                                    ),
                                ],
                            'list'  =>
                                [
                                    'type'    => 'Literal',
                                    'options' =>
                                        [
                                            'route'    => '/list',
                                            'defaults' => ['action' => 'list']
                                        ]
                                ],
                            'delete'  =>
                                [
                                    'type'    => 'Segment',
                                    'options' =>
                                        [
                                            'route'    => '/delete[/:ski-level_id]',
                                            'defaults' => ['action' => 'delete']
                                        ],
                                    'constraints' => array(
                                        'ski-level_id' => '[0-9]+'
                                    ),
                                ],
                        ]
                ],
            'ski'        =>
                [
                    'type'          => 'Literal',
                    'options'       =>
                        [
                            'route'    => '/ski',
                            'defaults' =>
                                [
                                    '__NAMESPACE__' => 'Application\Controller',
                                    'controller'    => 'Ski'
                                ]
                        ],
                    'may_terminate' => false,
                    'child_routes'  =>
                        [
                            'add'  =>
                                [
                                    'type'    => 'Literal',
                                    'options' =>
                                        [
                                            'route'    => '/add',
                                            'defaults' => ['action' => 'add-or-edit']
                                        ]
                                ],
                            'edit'  =>
                                [
                                    'type'    => 'Segment',
                                    'options' =>
                                        [
                                            'route'    => '/edit[/:ski_id]',
                                            'defaults' => ['action' => 'add-or-edit']
                                        ],
                                    'constraints' => array(
                                        'ski_id' => '[0-9]+'
                                    ),
                                ],
                            'list'  =>
                                [
                                    'type'    => 'Literal',
                                    'options' =>
                                        [
                                            'route'    => '/list',
                                            'defaults' => ['action' => 'list']
                                        ]
                                ],
                            'delete'  =>
                                [
                                    'type'    => 'Segment',
                                    'options' =>
                                        [
                                            'route'    => '/delete[/:ski_id]',
                                            'defaults' => ['action' => 'delete']
                                        ],
                                    'constraints' => array(
                                        'ski_id' => '[0-9]+'
                                    ),
                                ],
                        ]
                ],
            // The following is a route to simplify getting started creating
            // new controllers and actions without needing to create a new
            // module. Simply drop new controllers in, and you can access them
            // using the path /application/:controller/:action
            'application' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/application',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Application\Controller',
                        'controller'    => 'Index',
                        'action'        => 'index',
                    ),
                ),
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
                ),
            ),
        ),
    ),
    'service_manager' => array(
        'abstract_factories' => array(
            'Zend\Cache\Service\StorageCacheAbstractServiceFactory',
            'Zend\Log\LoggerAbstractServiceFactory',
        ),
        'factories' => array(
            'translator' => 'Zend\Mvc\Service\TranslatorServiceFactory',
        ),
    ),
    'translator' => array(
        'locale' => 'fr_FR',
        'translation_file_patterns' => array(
            array(
                'type'     => 'phparray',
                'base_dir' => __DIR__ . '/../language',
                'pattern'  => '%s.php',
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'Application\Controller\Index' => Controller\IndexController::class,
            'Application\Controller\User' => Controller\UserController::class,
            'Application\Controller\SkiLevel' => Controller\SkiLevelController::class,
            'Application\Controller\Ski' => Controller\SkiController::class,
        ),
    ),
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => array(
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
           // 'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
            'application/user/list' => __DIR__ . '/../view/application/user/list.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
    // Placeholder for console routes
    'console' => array(
        'router' => array(
            'routes' => array(
            ),
        ),
    ),
    'doctrine'        => array(
        'driver' => array(
            // defines an annotation driver with two paths, and names it `my_annotation_driver`
            'application_driver' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(
                    __DIR__ . '/../src/Application/Entity',
                ),
            ),
            // default metadata driver, aggregates all other drivers into a single one.
            // Override `orm_default` only if you know what you're doing
            'orm_default' => array(
                'drivers' => array(
                    // register `my_annotation_driver` for any entity under namespace `My\Namespace`
                    'Application\Entity' => 'application_driver'
                )
            )
        )
    )
);
