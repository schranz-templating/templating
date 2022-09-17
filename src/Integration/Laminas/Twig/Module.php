<?php

namespace Schranz\Templating\Integration\Laminas\Twig;

use Laminas\ModuleManager\Feature\ConfigProviderInterface;
use Laminas\ServiceManager\ServiceManager;
use Twig\Environment;
use Twig\Extension\DebugExtension;
use Twig\Loader\FilesystemLoader;
use Schranz\Templating\Adapter\Twig\TwigRenderer;
use Schranz\Templating\TemplateRenderer\TemplateRendererInterface;

class Module implements ConfigProviderInterface
{
    const MODULE_NAME = 'schranz_templating_twig';

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getServiceConfig(): array
    {
        return [
            'factories' => [
                'twig.loader' => function (ServiceManager $container) {
                    return new FilesystemLoader(
                        $container->get('config')[self::MODULE_NAME]['paths'],
                    );
                },
                'twig' => function (ServiceManager $container) {
                    $cache = $container->get('config')[self::MODULE_NAME]['cache'];
                    $debug = $container->get('config')[self::MODULE_NAME]['debug'] ?? false;
                    $strictVariables = $container->get('config')[self::MODULE_NAME]['strict_variables'] ?? $debug;
                    $optimizations = $container->get('config')[self::MODULE_NAME]['optimizations'];

                    $environment = new Environment(
                        $container->get('twig.loader'),
                        [
                            'debug' => $debug,
                            'cache' => $cache,
                            'strict_variables' => $strictVariables,
                            'optimizations' => $optimizations,
                        ]
                    );

                    if ($debug) {
                        $environment->addExtension(new DebugExtension());
                    }

                    foreach ($container->get('config')[self::MODULE_NAME]['extensions'] as $twigExtension) {
                        if (is_string($twigExtension)) {
                            $twigExtension = $container->get($twigExtension);
                        }

                        $environment->addExtension($container->get($twigExtension));
                    }

                    return $environment;
                },
                'schranz_templating.renderer.twig' => function (ServiceManager $container) {
                    return new TwigRenderer($container->get('twig'));
                },
            ],
            'aliases' => [
                TemplateRendererInterface::class => 'schranz_templating.renderer.twig',
                TwigRenderer::class => 'schranz_templating.renderer.twig',
            ],
        ];
    }
}
