<?php

namespace Schranz\Templating\Integration\Mezzio\Blade;

use Illuminate\View\Engines\CompilerEngine;
use Psr\Container\ContainerInterface;

class BladeEngineResolverBladeClosureFactory
{
    public function __invoke(ContainerInterface $container): \Closure
    {
        $filesystem = $container->get('blade.filesystem');
        $bladeCompiler = $container->get('blade.compiler');

        return function () use ($bladeCompiler, $filesystem) {
            return new CompilerEngine($bladeCompiler, $filesystem);
        };
    }
}
