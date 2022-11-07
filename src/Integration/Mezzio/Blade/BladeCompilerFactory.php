<?php

namespace Schranz\Templating\Integration\Mezzio\Blade;

use Illuminate\View\Compilers\BladeCompiler;
use Psr\Container\ContainerInterface;

class BladeCompilerFactory
{
    public function __invoke(ContainerInterface $container): BladeCompiler
    {
        $config = $container->get('config');

        return new BladeCompiler(
            $container->get('blade.filesystem'),
            $config['latte']['cache_dir'] ?? 'data/cache/blade'
        );
    }
}
