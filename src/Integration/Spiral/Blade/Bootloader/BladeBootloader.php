<?php

namespace Schranz\Templating\Integration\Spiral\Blade\Bootloader;

use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Contracts\View\Factory as FactoryContract;
use Illuminate\Events\Dispatcher;
use Illuminate\Filesystem\Filesystem;
use Illuminate\View\Compilers\BladeCompiler;
use Illuminate\View\Compilers\CompilerInterface;
use Illuminate\View\Engines\CompilerEngine;
use Illuminate\View\Engines\EngineResolver;
use Illuminate\View\Factory;
use Illuminate\View\FileViewFinder;
use Illuminate\View\ViewFinderInterface;
use Psr\Container\ContainerInterface;
use Schranz\Templating\Adapter\Blade\BladeRenderer;
use Schranz\Templating\Integration\Spiral\Blade\Config\BladeConfig;
use Schranz\Templating\TemplateRenderer\TemplateRendererInterface;
use Spiral\Boot\Bootloader\Bootloader;
use Spiral\Boot\DirectoriesInterface;
use Spiral\Core\BinderInterface;
use Spiral\Config\ConfiguratorInterface;

final class BladeBootloader extends Bootloader
{
    protected const SINGLETONS = [
        'schranz_templating.renderer.blade' => TemplateRendererInterface::class,
        'blade' => FactoryContract::class,
        Filesystem::class => Filesystem::class,
        'blade.filesystem' => Filesystem::class,
    ];

    public function __construct(
        private readonly ConfiguratorInterface $config
    ) {
    }

    public function init(DirectoriesInterface $dirs): void
    {
        $this->config->setDefaults(
            BladeConfig::CONFIG,
            [
                'paths' => [
                    $dirs->get('views'),
                ],
                'cache_dir' => $dirs->get('runtime') . '/cache/blade',
            ]
        );
    }

    public function boot(BinderInterface $binder): void
    {
        $binder->bindSingleton(
            CompilerInterface::class,
            static function (BladeConfig $config, Filesystem $filesystem): CompilerInterface {
                return new BladeCompiler(
                    $filesystem,
                    $config->getCacheDir()
                );
            }
        );

        $binder->bindSingleton(
            ViewFinderInterface::class,
            static function (BladeConfig $config, Filesystem $filesystem): ViewFinderInterface {
                return new FileViewFinder(
                    $filesystem,
                    $config->getPaths()
                );
            }
        );

        /* php closure not used when using blade for rendering but could be used this way
        $container->bindSingleton('blade.file_view_finder', function (Container $container) {
            $config = $container->get(BladeConfig::class);

            $filesystem = $container->get('blade.filesystem');

            return function () use ($filesystem) {
                return new PhpEngine($filesystem);
            };
        });
        */

        $binder->bindSingleton(
            'blade.engine_resolver_blade_closure',
            static function (Filesystem $filesystem, CompilerInterface $compiler) {
                return static function () use ($compiler, $filesystem) {
                    return new CompilerEngine($compiler, $filesystem);
                };
            }
        );

        $binder->bindSingleton(EngineResolver::class, static function (ContainerInterface $container): EngineResolver {
            $engineResolver = new EngineResolver();

            $engineResolver->register('blade', $container->get('blade.engine_resolver_blade_closure'));
            // php closure not used when using blade for rendering but could replace the above replace this way:
            // $engineResolver->register('blade', $container->get('blade.engine_resolver_php_closure'));

            return $engineResolver;
        });

        $binder->bindSingleton(DispatcherContract::class, Dispatcher::class);

        $binder->bindSingleton(
            FactoryContract::class,
            static function (
                EngineResolver $resolver,
                ViewFinderInterface $finder,
                DispatcherContract $dispatcher
            ): FactoryContract {
                return new Factory(
                    $resolver,
                    $finder,
                    $dispatcher,
                );
            }
        );

        $binder->bindSingleton(
            TemplateRendererInterface::class,
            static function (FactoryContract $factory): TemplateRendererInterface {
                return new BladeRenderer($factory);
            }
        );
    }
}
