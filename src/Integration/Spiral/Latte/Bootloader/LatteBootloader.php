<?php

namespace Schranz\Templating\Integration\Spiral\Latte\Bootloader;

use Latte\Engine;
use Latte\Loader;
use Latte\Loaders\FileLoader;
use Schranz\Templating\Adapter\Latte\LatteRenderer;
use Schranz\Templating\Integration\Spiral\Latte\Config\LatteConfig;
use Schranz\Templating\TemplateRenderer\TemplateRendererInterface;
use Spiral\Boot\Bootloader\Bootloader;
use Spiral\Core\Container;
use Spiral\Config\ConfiguratorInterface;

final class LatteBootloader extends Bootloader
{
    protected const SINGLETONS = [
        LatteRenderer::class => LatteRenderer::class,
        TemplateRendererInterface::class => LatteRenderer::class,
    ];

    public function __construct(
        private readonly ConfiguratorInterface $config
    ) {
    }

    public function init(): void {
        $this->config->setDefaults(
            LatteConfig::CONFIG,
            [
                'path' => 'app/views',
                'cache_dir' => 'runtime/cache/latte',
            ]
        );
    }

    public function boot(Container $container): void
    {
        $container->bindSingleton(Loader::class, function (Container $container) {
            $config = $container->get(LatteConfig::class);

            return new FileLoader($config->getPath());
        });

        $container->bindSingleton(Engine::class, function (Container $container) {
            $config = $container->get(LatteConfig::class);

            $engine = new Engine();
            $engine->setTempDirectory($config->getCacheDir());
            $engine->setLoader($container->get(Loader::class));

            // TODO implement latte extensions

            return $engine;
        });
    }
}
