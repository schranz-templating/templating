<?php

namespace Schranz\Templating\Integration\Mezzio\Blade;

use Illuminate\View\Engines\PhpEngine;
use Psr\Container\ContainerInterface;

class BladeEngineResolverPHPClosureFactory
{
    public function __invoke(ContainerInterface $container): \Closure
    {
        $filesystem = $container->get('blade.filesystem');

        return function () use ($filesystem) {
            return new PhpEngine($filesystem);
        };
    }
}
