<?php

namespace Schranz\Templating\Integration\Spiral\Blade\Bootloader;

use Illuminate\Events\Dispatcher;
use Illuminate\Filesystem\Filesystem;
use Illuminate\View\Compilers\BladeCompiler;
use Illuminate\View\Engines\CompilerEngine;
use Illuminate\View\Engines\EngineResolver;
use Illuminate\View\Engines\PhpEngine;
use Illuminate\View\Factory;
use Illuminate\View\FileViewFinder;
use Schranz\Templating\Adapter\Blade\BladeRenderer;
use Schranz\Templating\Integration\Spiral\Blade\Config\BladeConfig;
use Schranz\Templating\TemplateRenderer\TemplateRendererInterface;
use Spiral\Boot\Bootloader\Bootloader;
use Spiral\Core\Container;
use Spiral\Config\ConfiguratorInterface;

final class BladeBootloader extends Bootloader
{
    public function __construct(
        private readonly ConfiguratorInterface $config
    ) {
    }

    public function init(): void {
        $this->config->setDefaults(
            BladeConfig::CONFIG,
            [
                'paths' => [
                    'app/views'
                ],
                'cache_dir' => 'runtime/cache/blade',
            ]
        );
    }

    public function boot(Container $container): void
    {
        $container->bindSingleton('blade.filesystem', function (Container $container) {
            return new Filesystem();
        });

        $container->bindSingleton('blade.compiler', function (Container $container) {
            $config = $container->get(BladeConfig::class);

            return new BladeCompiler(
                $container->get('blade.filesystem'),
                $config->getCacheDir()
            );
        });

        $container->bindSingleton('blade.file_view_finder', function (Container $container) {
            $config = $container->get(BladeConfig::class);

            return new FileViewFinder(
                $container->get('blade.filesystem'),
                $config->getPaths()
            );
        });

        /* php closure not used when using blade for rendering but could be used this way
        $container->bindSingleton('blade.file_view_finder', function (Container $container) {
            $config = $container->get(BladeConfig::class);

            $filesystem = $container->get('blade.filesystem');

            return function () use ($filesystem) {
                return new PhpEngine($filesystem);
            };
        });
        */

        $container->bindSingleton('blade.engine_resolver_blade_closure', function (Container $container) {
            $filesystem = $container->get('blade.filesystem');
            $bladeCompiler = $container->get('blade.compiler');

            return function () use ($bladeCompiler, $filesystem) {
                return new CompilerEngine($bladeCompiler, $filesystem);
            };
        });

        $container->bindSingleton('blade.engine_resolver', function (Container $container) {
            $engineResolver = new EngineResolver();

            $engineResolver->register('blade', $container->get('blade.engine_resolver_blade_closure'));
            // php closure not used when using blade for rendering but could replace the above replace this way:
            // $engineResolver->register('blade', $container->get('blade.engine_resolver_php_closure'));

            return $engineResolver;
        });

        $container->bindSingleton('blade.dispatcher', function (Container $container) {
            return new Dispatcher();
        });

        $container->bindSingleton('blade', function (Container $container) {
            return new Factory(
                $container->get('blade.engine_resolver'),
                $container->get('blade.file_view_finder'),
                $container->get('blade.dispatcher'),
            );
        });

        $container->bind(Factory::class, 'blade');

        $container->bindSingleton('schranz_templating.renderer.blade', function (Container $container) {
            return new BladeRenderer($container->get('blade'));
        });

        $container->bind(TemplateRendererInterface::class, 'schranz_templating.renderer.blade');
        $container->bind(BladeRenderer::class, 'schranz_templating.renderer.blade');
    }
}
