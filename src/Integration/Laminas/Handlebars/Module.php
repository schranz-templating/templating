<?php

namespace Schranz\Templating\Integration\Laminas\Handlebars;

use Handlebars\Cache\Disk;
use Handlebars\Handlebars;
use Handlebars\Loader\FilesystemLoader;
use Laminas\ModuleManager\Feature\ConfigProviderInterface;
use Laminas\ServiceManager\ServiceManager;
use Schranz\Templating\Bridge\Handlebars\HandlebarsRenderer;
use Schranz\Templating\TemplateRenderer\TemplateRendererInterface;

class Module implements ConfigProviderInterface
{
    const MODULE_NAME = 'schranz_templating_handlebars';

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getServiceConfig(): array
    {
        return [
            'factories' => [
                'handlebars.filesystem_loader' => function (ServiceManager $container) {
                    return new FilesystemLoader(
                        $container->get('config')[self::MODULE_NAME]['path'],
                    );
                },
                'handlebars.cache' => function (ServiceManager $container) {
                    return new Disk(
                        $container->get('config')[self::MODULE_NAME]['cache'],
                    );
                },
                'handlebars' => function (ServiceManager $container) {
                    return new Handlebars(
                        [
                            'cache' => $container->get('handlebars.cache'),
                            'loader' => $container->get('handlebars.filesystem_loader'),
                        ]
                    );
                },
                'schranz_templating.renderer.handlebars' => function (ServiceManager $container) {
                    return new HandlebarsRenderer($container->get('handlebars'));
                },
            ],
            'aliases' => [
                TemplateRendererInterface::class => 'schranz_templating.renderer.handlebars',
                HandlebarsRenderer::class => 'schranz_templating.renderer.handlebars',
            ],
        ];
    }
}
