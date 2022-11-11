<?php

namespace Schranz\Templating\Integration\Spiral\Latte\Bootloader;

use Latte\Engine;
use Latte\Loaders\FileLoader;
use Schranz\Templating\Adapter\Latte\LatteRenderer;
use Schranz\Templating\Integration\Spiral\Latte\Config\LatteConfig;
use Schranz\Templating\TemplateRenderer\TemplateRendererInterface;
use Spiral\Boot\Bootloader\Bootloader;
use Spiral\Core\Container;
use Spiral\Config\ConfiguratorInterface;

final class LatteBootloader extends Bootloader
{
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
        $container->bindSingleton('latte.loader', function (Container $container) {
            $config = $container->get(LatteConfig::class);

            return new FileLoader($config->getPath());
        });

        $container->bindSingleton('latte', function (Container $container) {
            $config = $container->get(LatteConfig::class);

            $engine = new Engine();
            $engine->setTempDirectory($config->getCacheDir());
            $engine->setLoader($container->get('latte.loader'));

            // TODO implement latte extensions

            return $engine;
        });

        $container->bind(Engine::class, 'latte');

        $container->bindSingleton('schranz_templating.renderer.latte', function (Container $container) {
            return new LatteRenderer($container->get('latte'));
        });

        $container->bind(TemplateRendererInterface::class, 'schranz_templating.renderer.latte');
        $container->bind(LatteRenderer::class, 'schranz_templating.renderer.latte');
    }
}
