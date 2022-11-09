<?php

namespace Schranz\Templating\Integration\Spiral\Handlebars\Bootloader;

use Handlebars\Cache\Disk;
use Handlebars\Handlebars;
use Handlebars\Loader\FilesystemLoader;
use Schranz\Templating\Adapter\Handlebars\HandlebarsRenderer;
use Schranz\Templating\Integration\Spiral\Handlebars\Config\HandlebarsConfig;
use Schranz\Templating\TemplateRenderer\TemplateRendererInterface;
use Spiral\Boot\Bootloader\Bootloader;
use Spiral\Core\Container;
use Spiral\Config\ConfiguratorInterface;

final class HandlebarsBootloader extends Bootloader
{
    public function __construct(
        private readonly ConfiguratorInterface $config
    ) {
    }

    public function init(): void {
        $this->config->setDefaults(
            HandlebarsConfig::CONFIG,
            [
                'path' => 'app/views',
                'cache_dir' => 'runtime/cache/handlebars',
            ]
        );
    }

    public function boot(Container $container): void
    {
        $container->bindSingleton('handlebars.filesystem_loader', function (Container $container) {
            $config = $container->get(HandlebarsConfig::class);

            return new FilesystemLoader($config->getPath());
        });

        $container->bindSingleton('handlebars.cache', function (Container $container) {
            $config = $container->get(HandlebarsConfig::class);

            return new Disk($config->getCacheDir());
        });

        $container->bindSingleton('handlebars', function (Container $container) {
            return new Handlebars(
                [
                    'cache' => $container->get('handlebars.cache'),
                    'loader' => $container->get('handlebars.filesystem_loader'),
                ]
            );
        });

        $container->bind(Handlebars::class, 'handlebars');

        $container->bindSingleton('schranz_templating.renderer.handlebars', function (Container $container) {
            return new HandlebarsRenderer($container->get('handlebars'));
        });

        $container->bind(TemplateRendererInterface::class, 'schranz_templating.renderer.handlebars');
        $container->bind(HandlebarsRenderer::class, 'schranz_templating.renderer.handlebars');
    }
}
