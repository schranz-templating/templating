<?php

namespace Schranz\Templating\Integration\Spiral\Handlebars\Bootloader;

use Handlebars\Cache;
use Handlebars\Cache\Disk;
use Handlebars\Handlebars;
use Handlebars\Loader;
use Handlebars\Loader\FilesystemLoader;
use Schranz\Templating\Adapter\Handlebars\HandlebarsRenderer;
use Schranz\Templating\Integration\Spiral\Handlebars\Config\HandlebarsConfig;
use Schranz\Templating\TemplateRenderer\TemplateRendererInterface;
use Spiral\Boot\Bootloader\Bootloader;
use Spiral\Core\Container;
use Spiral\Config\ConfiguratorInterface;

final class HandlebarsBootloader extends Bootloader
{
    protected const SINGLETONS = [
        HandlebarsRenderer::class => HandlebarsRenderer::class,
        TemplateRendererInterface::class => HandlebarsRenderer::class,
    ];

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
        $container->bindSingleton(Loader::class, function (Container $container) {
            $config = $container->get(HandlebarsConfig::class);

            return new FilesystemLoader($config->getPath());
        });

        $container->bindSingleton(Cache::class, function (Container $container) {
            $config = $container->get(HandlebarsConfig::class);

            return new Disk($config->getCacheDir());
        });

        $container->bindSingleton(Handlebars::class, function (Container $container) {
            return new Handlebars(
                [
                    'cache' => $container->get(Cache::class),
                    'loader' => $container->get(Loader::class),
                ]
            );
        });
    }
}
