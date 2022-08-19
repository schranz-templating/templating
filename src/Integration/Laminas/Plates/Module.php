<?php

namespace Schranz\Templating\Integration\Laminas\Plates;

use Laminas\ModuleManager\Feature\ConfigProviderInterface;
use Laminas\ServiceManager\ServiceManager;
use League\Plates\Engine;
use Schranz\Templating\Bridge\Plates\PlatesRenderer;
use Schranz\Templating\TemplateRenderer\TemplateRendererInterface;

class Module implements ConfigProviderInterface
{
    const MODULE_NAME = 'schranz_templating_plates';

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getServiceConfig(): array
    {
        return [
            'factories' => [
                'schranz_templating.renderer.plates' => function (ServiceManager $container) {
                    return new PlatesRenderer($container->get('plates'));
                },
                'plates' => function (ServiceManager $container) {
                    $config  = $container->get('Configuration');

                    $name = static::MODULE_NAME;
                    $options = empty($config[$name]) ? [] : $config[$name];

                    $cache = $options['cache'] ?? null;
                    $paths = $options['paths'] ?? [];

                    $engine = new Engine(
                        $paths[0],
                    );

                    unset($paths[0]);
                    foreach ($paths as $path) {
                        $engine->addFolder($path);
                    }

                    return $engine;
                },
            ],
            'aliases' => [
                TemplateRendererInterface::class => 'schranz_templating.renderer.plates',
                PlatesRenderer::class => 'schranz_templating.renderer.plates',
            ],
        ];
    }
}
