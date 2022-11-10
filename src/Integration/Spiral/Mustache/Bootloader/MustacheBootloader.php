<?php

namespace Schranz\Templating\Integration\Spiral\Mustache\Bootloader;

use Mustache_Engine;
use Mustache_Loader_FilesystemLoader;
use Schranz\Templating\Adapter\Mustache\MustacheRenderer;
use Schranz\Templating\Integration\Spiral\Mustache\Config\MustacheConfig;
use Schranz\Templating\TemplateRenderer\TemplateRendererInterface;
use Spiral\Boot\Bootloader\Bootloader;
use Spiral\Core\Container;
use Spiral\Config\ConfiguratorInterface;

final class MustacheBootloader extends Bootloader
{
    public function __construct(
        private readonly ConfiguratorInterface $config
    ) {
    }

    public function init(): void {
        $this->config->setDefaults(
            MustacheConfig::CONFIG,
            [
                'path' => 'app/views',
                'cache_dir' => 'runtime/cache/mustache',
            ]
        );
    }

    public function boot(Container $container): void
    {
        $container->bindSingleton('mustache.filesystem_loader', function (Container $container) {
            $config = $container->get(MustacheConfig::class);

            return new Mustache_Loader_FilesystemLoader($config->getPath());
        });

        $container->bindSingleton('mustache', function (Container $container) {
            $config = $container->get(MustacheConfig::class);

            return new Mustache_Engine([
                'cache' => $config->getCacheDir(),
                'loader' => $container->get('mustache.filesystem_loader'),
                'charset' => 'UTF-8',
            ]);
        });

        $container->bind(Mustache_Engine::class, 'mustache');

        $container->bindSingleton('schranz_templating.renderer.mustache', function (Container $container) {
            return new MustacheRenderer($container->get('mustache'));
        });

        $container->bind(TemplateRendererInterface::class, 'schranz_templating.renderer.mustache');
        $container->bind(MustacheRenderer::class, 'schranz_templating.renderer.mustache');
    }
}
