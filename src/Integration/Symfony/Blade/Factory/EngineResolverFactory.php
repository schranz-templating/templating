<?php

namespace Schranz\Templating\Integration\Symfony\Blade\Factory;

use Illuminate\Filesystem\Filesystem;
use Illuminate\View\Compilers\BladeCompiler;
use Illuminate\View\Engines\CompilerEngine;
use Illuminate\View\Engines\PhpEngine;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Reference;

/**
 * @internal
 */
class EngineResolverFactory
{
    public static function createBladeEngineClosure(Filesystem $filesystem, BladeCompiler $bladeCompiler): \Closure
    {
        return function () use ($bladeCompiler, $filesystem) {
            return new CompilerEngine($bladeCompiler, $filesystem);
        };
    }

    public static function createPhpEngineClosure(Filesystem $filesystem): \Closure
    {
        /* Currently not used but could be also registered via:
        $container->setDefinition(
            'blade.engine_resolver_php_closure',
            (new Definition(\Closure::class, [
                new Reference('blade.filesystem'),
            ]))
                ->setFactory([EngineResolverFactory::class, 'createPhpEngineClosure'])
        )
            ->setPublic(true);

        $container->setDefinition(
            'blade.engine_resolver',
            (new Definition(EngineResolver::class))
                // replaces the other register call
                ->addMethodCall('register', [
                    'blade',
                    new Reference('blade.engine_resolver_php_closure'),
                ])
        );
        */

        return function () use ($filesystem) {
            return new PhpEngine($filesystem);
        };
    }
}
