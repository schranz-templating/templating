<?php

namespace Schranz\Templating\Integration\Laminas\Mustache;

use Laminas\ModuleManager\Feature\ConfigProviderInterface;
use Laminas\ServiceManager\ServiceManager;
use Schranz\Templating\Adapter\Mustache\MustacheRenderer;
use Schranz\Templating\TemplateRenderer\TemplateRendererInterface;

class Module implements ConfigProviderInterface
{
    const MODULE_NAME = 'schranz_templating_mustache';

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getServiceConfig(): array
    {
        return [
            'factories' => [
                'mustache.filesystem_loader' => function (ServiceManager $container) {
                    return new \Mustache_Loader_FilesystemLoader(
                        $container->get('config')[self::MODULE_NAME]['path'],
                    );
                },
                'mustache' => function (ServiceManager $container) {
                    return new \Mustache_Engine(
                        [
                            'cache' => $container->get('config')[self::MODULE_NAME]['cache'],
                            'loader' => $container->get('mustache.filesystem_loader'),
                            'charset' => 'UTF-8',
                        ]
                    );
                },
                'schranz_templating.renderer.mustache' => function (ServiceManager $container) {
                    return new MustacheRenderer($container->get('mustache'));
                },
            ],
            'aliases' => [
                TemplateRendererInterface::class => 'schranz_templating.renderer.mustache',
                MustacheRenderer::class => 'schranz_templating.renderer.mustache',
            ],
        ];
    }
}
