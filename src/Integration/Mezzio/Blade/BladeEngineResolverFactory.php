<?php

namespace Schranz\Templating\Integration\Mezzio\Blade;

use Illuminate\View\Engines\EngineResolver;
use Psr\Container\ContainerInterface;

class BladeEngineResolverFactory
{
    public function __invoke(ContainerInterface $container): EngineResolver
    {
        $engineResolver = new EngineResolver();

        $engineResolver->register('blade', $container->get('blade.engine_resolver_blade_closure'));
        // php closure not used when using blade for rendering but could replace the above replace this way:
        // $engineResolver->register('blade', $container->get('blade.engine_resolver_php_closure'));

        return $engineResolver;
    }
}
