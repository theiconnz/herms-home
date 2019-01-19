<?php
/**
 * Herms Home (https://theicon.co.nz/)
 *
 * Module
 *
 * PHP version 7
 *
 * @category Module
 * @package  HermsHome
 * @author   Don Nuwinda <nuwinda@gmail.com>
 * @license  GPL http://theicon.co.nz
 * @link     http://theicon.co.nz
 */
namespace HermsHome;

use Zend\Router\Http\Literal;
use Zend\Router\Http\Segment;
use Zend\ServiceManager\Factory\InvokableFactory;

return [
    'router' => [
        'routes' => [
            'home' => [
                'type' => Literal::class,
                'options' => [
                    'route'    => '/',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
            'login' => [
                'type' => Literal::class,
                'options' => [
                    'route'    => '/login',
                    'defaults' => [
                        'controller'    => Controller\LoginController::class,
                        'action'        => 'process',
                    ],
                ],
				'may_terminate' => true,
				'child_routes' => [
					'logout' => [
						'type' => Literal::class,
						'options' => [
							'route' => '/logout',
							'defaults' => [
								'action' => 'logout',
							]
						],
					],
				    'resetpassword' => [
				        'type' => Literal::class,
				        'options' => [
				            'route' => '/resetpassword',
				            'defaults' => [
				                'action' => 'resetpassword',
				            ]
				        ],
				    ],
				],
            ],
            'dashboard' => [
                'type' => Literal::class,
                'options' => [
                    'route'    => '/dashboard',
                    'defaults' => [
                        'controller'    => Controller\DashboardController::class,
                        'action'        => 'index',
                    ],
                ],
            ],
        ],
    ],
    'controllers' => [
        'factories' => [
            Controller\IndexController::class => 'HermsHome\Factory\IndexControllerFactory',
            Controller\LoginController::class => 'HermsHome\Factory\LoginControllerFactory',
			Controller\DashboardController::class => 'HermsHome\Factory\DashboardControllerFactory',
        ],
    ],
    'view_manager' => [
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        "base_path"                => "/",
        'template_map' => [
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            'herms-home/index/index'     => 
            __DIR__ . '/../view/application/index/index.phtml',
			'herms-home/dashboard/index' =>
			__DIR__ . '/../view/error/404.phtml',
            'login/process/layout'    => 
            __DIR__ . '/../view/layout/empty.phtml',
            'dashboard/index/layout'  => 
            __DIR__ . '/../view/layout/dashboard.phtml',
			'herms-home/dashboard/index'  => 
            __DIR__ . '/../view/layout/content/dashboard.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
			'admin/footer'			  => __DIR__ . '/../view/layout/footer.phtml',
			'admin/header'			  => __DIR__ . '/../view/layout/adminheader.phtml',
			'admin/sidebar/menu'	  => __DIR__ . '/../view/layout/sidebar/menu.phtml',
        ],
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
];