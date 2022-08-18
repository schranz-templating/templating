<?php

declare(strict_types=1);

namespace Application;

use Laminas\Router\Http\Literal;
use Laminas\ServiceManager\Factory\InvokableFactory;
use Schranz\Templating\Bridge\Plates\PlatesRenderer;
use Schranz\Templating\TemplateRenderer\TemplateRendererInterface;

return [
    'router' => [
        'routes' => [
            'home' => [
                'type'    => Literal::class,
                'options' => [
                    'route'    => '/',
                    'defaults' => [
                        'controller' => Controller\TemplateController::class,
                        'action' => 'home',
                    ],
                ],
            ],
            'plates' => [
                'type'    => Literal::class,
                'options' => [
                    'route'    => '/plates',
                    'defaults' => [
                        'controller' => Controller\TemplateController::class,
                        'action'     => 'platesRenderer',
                    ],
                ],
            ],
        ],
    ],
    'controllers' => [
        'factories' => [
            Controller\IndexController::class => InvokableFactory::class,
            Controller\TemplateController::class  => function($container) {
                return new Controller\TemplateController(
                    $container->get(TemplateRendererInterface::class),
                    $container->get(PlatesRenderer::class),
                );
            },
        ],
    ],
    'view_manager' => [
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => [
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ],
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
];
