<?php

declare(strict_types=1);

namespace Application;

use Laminas\Router\Http\Literal;
use Schranz\Templating\Bridge\Blade\BladeRenderer;
use Schranz\Templating\Bridge\Handlebars\HandlebarsRenderer;
use Schranz\Templating\Bridge\LaminasView\LaminasViewRenderer;
use Schranz\Templating\Bridge\Latte\LatteRenderer;
use Schranz\Templating\Bridge\Mustache\MustacheRenderer;
use Schranz\Templating\Bridge\Plates\PlatesRenderer;
use Schranz\Templating\Bridge\Smarty\SmartyRenderer;
use Schranz\Templating\Bridge\Twig\TwigRenderer;
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
            'blade' => [
                'type'    => Literal::class,
                'options' => [
                    'route'    => '/blade',
                    'defaults' => [
                        'controller' => Controller\TemplateController::class,
                        'action'     => 'bladeRenderer',
                    ],
                ],
            ],
            'handlebars' => [
                'type'    => Literal::class,
                'options' => [
                    'route'    => '/handlebars',
                    'defaults' => [
                        'controller' => Controller\TemplateController::class,
                        'action'     => 'handlebarsRenderer',
                    ],
                ],
            ],
            'mustache' => [
                'type'    => Literal::class,
                'options' => [
                    'route'    => '/mustache',
                    'defaults' => [
                        'controller' => Controller\TemplateController::class,
                        'action'     => 'mustacheRenderer',
                    ],
                ],
            ],
            'latte' => [
                'type'    => Literal::class,
                'options' => [
                    'route'    => '/latte',
                    'defaults' => [
                        'controller' => Controller\TemplateController::class,
                        'action'     => 'latteRenderer',
                    ],
                ],
            ],
            'laminas_view' => [
                'type'    => Literal::class,
                'options' => [
                    'route'    => '/laminas-view',
                    'defaults' => [
                        'controller' => Controller\TemplateController::class,
                        'action'     => 'laminasViewRenderer',
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
            'smarty' => [
                'type'    => Literal::class,
                'options' => [
                    'route'    => '/smarty',
                    'defaults' => [
                        'controller' => Controller\TemplateController::class,
                        'action'     => 'smartyRenderer',
                    ],
                ],
            ],
            'twig' => [
                'type'    => Literal::class,
                'options' => [
                    'route'    => '/twig',
                    'defaults' => [
                        'controller' => Controller\TemplateController::class,
                        'action'     => 'twigRenderer',
                    ],
                ],
            ],
        ],
    ],
    'controllers' => [
        'factories' => [
            Controller\TemplateController::class  => function($container) {
                return new Controller\TemplateController(
                    $container->get(TemplateRendererInterface::class),
                    $container->get(BladeRenderer::class),
                    $container->get(HandlebarsRenderer::class),
                    $container->get(LaminasViewRenderer::class),
                    $container->get(LatteRenderer::class),
                    $container->get(MustacheRenderer::class),
                    $container->get(PlatesRenderer::class),
                    $container->get(SmartyRenderer::class),
                    $container->get(TwigRenderer::class),
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
