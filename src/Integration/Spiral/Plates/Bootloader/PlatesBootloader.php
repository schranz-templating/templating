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
        $container->bindSingleton('plates', function (Container $container) {
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

        $container->bind(Engine::class, 'plates');

        $container->bindSingleton('schranz_templating.renderer.plates', function (Container $container) {
            return new PlatesRenderer($container->get('plates'));
        });

        $container->bind(TemplateRendererInterface::class, 'schranz_templating.renderer.plates');
        $container->bind(PlatesRenderer::class, 'schranz_templating.renderer.plates');
    }
}
