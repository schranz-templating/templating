<?php

namespace Schranz\Templating\Integration\Spiral\Mustache\Bootloader;

use Mustache_Engine;
use Mustache_Loader;
use Mustache_Loader_FilesystemLoader;
use Schranz\Templating\Adapter\Mustache\MustacheRenderer;
use Schranz\Templating\Integration\Spiral\Mustache\Config\MustacheConfig;
use Schranz\Templating\TemplateRenderer\TemplateRendererInterface;
use Spiral\Boot\Bootloader\Bootloader;
use Spiral\Core\Container;
use Spiral\Config\ConfiguratorInterface;

final class MustacheBootloader extends Bootloader
{
    protected const SINGLETONS = [
        MustacheRenderer::class => MustacheRenderer::class,
        TemplateRendererInterface::class => MustacheRenderer::class,
    ];

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
        $container->bindSingleton(Mustache_Loader::class, function (Container $container) {
            $config = $container->get(MustacheConfig::class);

            return new Mustache_Loader_FilesystemLoader($config->getPath());
        });

        $container->bindSingleton(Mustache_Engine::class, function (Container $container) {
            $config = $container->get(MustacheConfig::class);

            return new Mustache_Engine([
                'cache' => $config->getCacheDir(),
                'loader' => $container->get(Mustache_Loader::class),
                'charset' => 'UTF-8',
            ]);
        });
    }
}
