<?php

namespace Schranz\Templating\Integration\Symfony\Blade\DependencyInjection;

use Illuminate\Events\Dispatcher;
use Illuminate\Filesystem\Filesystem;
use Illuminate\View\Compilers\BladeCompiler;
use Illuminate\View\Engines\EngineResolver;
use Illuminate\View\Factory;
use Illuminate\View\FileViewFinder;
use Schranz\Templating\Bridge\Blade\BladeRenderer;
use Schranz\Templating\Integration\Symfony\Blade\Factory\EngineResolverFactory;
use Schranz\Templating\TemplateRenderer\TemplateRendererInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

/**
 * @internal
 */
class SchranzTemplatingBladeExtension extends Extension
{
    public function getAlias(): string
    {
        return 'schranz_templating_blade';
    }

    /**
     * @return void
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $this->loadBlade($config, $container);

        $definition = new Definition(
            BladeRenderer::class,
            [
                new Reference('blade'),
            ]
        );

        $container->setDefinition(
            'schranz_templating.renderer.blade',
            $definition
        );

        $container->setAlias(
            TemplateRendererInterface::class,
            'schranz_templating.renderer.blade'
        );

        $container->registerAliasForArgument(
            'schranz_templating.renderer.blade',
            TemplateRendererInterface::class,
            'bladeRenderer'
        );
    }

    /**
     * @return void
     */
    private function loadBlade(array $config, ContainerBuilder $container)
    {
        $paths = (array) $config['default_path'];
        $paths = array_merge($config['paths'] ?: [], $paths);
        $cache = $config['cache'];

        $container->setDefinition('blade.filesystem', new Definition(Filesystem::class));

        $container->setDefinition('blade.compiler', new Definition(BladeCompiler::class, [
            new Reference('blade.filesystem'),
            $cache,
        ]));

        $container->setDefinition('blade.file_view_finder', new Definition(
            FileViewFinder::class,
            [
                new Reference('blade.filesystem'),
                $paths
            ]
        ));

        $container->setDefinition(
            'blade.engine_resolver_php_closure',
            (new Definition(\Closure::class, [
                new Reference('blade.filesystem'),
            ]))
                ->setFactory([EngineResolverFactory::class, 'createPhpEngineClosure'])
        )
            ->setPublic(true);

        $container->setDefinition(
            'blade.engine_resolver_blade_closure',
            (new Definition(\Closure::class, [
                new Reference('blade.filesystem'),
                new Reference('blade.compiler'),
            ]))
                ->setFactory([EngineResolverFactory::class, 'createBladeEngineClosure'])
        );

        $container->setDefinition(
            'blade.engine_resolver',
            (new Definition(EngineResolver::class))
                ->addMethodCall('register', [
                    'blade',
                    new Reference('blade.engine_resolver_blade_closure'),
                ])
                ->addMethodCall('register', [
                    'blade',
                    new Reference('blade.engine_resolver_php_closure'),
                ])
        );

        $container->getDefinition('blade.engine_resolver')
            ->addMethodCall('register', [
                'blade',
                new Reference('blade.engine_resolver_blade_closure'),
            ]);

        $container->setDefinition('blade.dispatcher', new Definition(Dispatcher::class));

        $container->setDefinition('blade', new Definition(
            Factory::class,
            [
                new Reference('blade.engine_resolver'),
                new Reference('blade.file_view_finder'),
                new Reference('blade.dispatcher'),
            ]
        ));

        $container->setAlias(
            Factory::class,
            'blade'
        );
    }
}
