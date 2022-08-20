<?php

namespace Schranz\Templating\Integration\Laminas\Blade;

use Illuminate\Events\Dispatcher;
use Illuminate\Filesystem\Filesystem;
use Illuminate\View\Compilers\BladeCompiler;
use Illuminate\View\Engines\CompilerEngine;
use Illuminate\View\Engines\EngineResolver;
use Illuminate\View\Engines\PhpEngine;
use Illuminate\View\Factory;
use Illuminate\View\FileViewFinder;
use Laminas\ModuleManager\Feature\ConfigProviderInterface;
use Laminas\ServiceManager\ServiceManager;
use Schranz\Templating\Bridge\Blade\BladeRenderer;
use Schranz\Templating\TemplateRenderer\TemplateRendererInterface;

class Module implements ConfigProviderInterface
{
    const MODULE_NAME = 'schranz_templating_blade';

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getServiceConfig(): array
    {
        return [
            'factories' => [
                'blade.filesystem' => function () {
                    return new Filesystem();
                },
                'blade.compiler' => function (ServiceManager $container) {
                    return new BladeCompiler(
                        $container->get('blade.filesystem'),
                        $container->get('config')['schranz_templating_blade']['cache']
                    );
                },
                'blade.file_view_finder' => function (ServiceManager $container) {
                    return new FileViewFinder(
                        $container->get('blade.filesystem'),
                        $container->get('config')['schranz_templating_blade']['paths']
                    );
                },
                /* php closure not used when using blade for rendering but could be used this way
                'blade.engine_resolver_php_closure' => function (ServiceManager $container) {
                    $filesystem = $container->get('blade.filesystem');

                    return function () use ($filesystem) {
                        return new PhpEngine($filesystem);
                    };
                },
                */
                'blade.engine_resolver_blade_closure' => function (ServiceManager $container) {
                    $filesystem = $container->get('blade.filesystem');
                    $bladeCompiler = $container->get('blade.compiler');

                    return function () use ($bladeCompiler, $filesystem) {
                        return new CompilerEngine($bladeCompiler, $filesystem);
                    };
                },
                'blade.engine_resolver' => function (ServiceManager $container) {
                    $engineResolver = new EngineResolver();

                    $engineResolver->register('blade', $container->get('blade.engine_resolver_blade_closure'));
                    // php closure not used when using blade for rendering but could replace the above replace this way:
                    // $engineResolver->register('blade', $container->get('blade.engine_resolver_php_closure'));

                    return $engineResolver;
                },
                'blade.dispatcher' => function () {
                    return new Dispatcher();
                },
                'blade' => function (ServiceManager $container) {
                    return new Factory(
                        $container->get('blade.engine_resolver'),
                        $container->get('blade.file_view_finder'),
                        $container->get('blade.dispatcher'),
                    );
                },
                'schranz_templating.renderer.blade' => function (ServiceManager $container) {
                    return new BladeRenderer($container->get('blade'));
                },
            ],
            'aliases' => [
                TemplateRendererInterface::class => 'schranz_templating.renderer.blade',
                BladeRenderer::class => 'schranz_templating.renderer.blade',
            ],
        ];
    }
}
