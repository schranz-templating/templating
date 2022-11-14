<?php

namespace Schranz\Templating\Integration\Spiral\Plates\Bootloader;

use League\Plates\Engine;
use Schranz\Templating\Adapter\Plates\PlatesRenderer;
use Schranz\Templating\Integration\Spiral\Plates\Config\PlatesConfig;
use Schranz\Templating\TemplateRenderer\TemplateRendererInterface;
use Spiral\Boot\Bootloader\Bootloader;
use Spiral\Core\Container;
use Spiral\Config\ConfiguratorInterface;

final class PlatesBootloader extends Bootloader
{
    protected const SINGLETONS = [
        PlatesRenderer::class => PlatesRenderer::class,
        TemplateRendererInterface::class => PlatesRenderer::class,
    ];

    public function __construct(
        private readonly ConfiguratorInterface $config
    ) {
    }

    public function init(): void {
        $this->config->setDefaults(
            PlatesConfig::CONFIG,
            [
                'paths' => [
                    'app/views',
                ],
            ]
        );
    }

    public function boot(Container $container): void
    {
        $container->bindSingleton(Engine::class, function (Container $container) {
            $config = $container->get(PlatesConfig::class);

            $paths = $config->getPaths();

            $engine = new Engine(
                $paths[0],
            );

            unset($paths[0]);
            foreach ($paths as $path) {
                $engine->addFolder($path);
            }

            return $engine;
        });
    }
}
