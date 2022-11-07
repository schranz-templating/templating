<?php

namespace Schranz\Templating\Integration\Mezzio\Latte;

use Latte\Loaders\FileLoader;
use Psr\Container\ContainerInterface;

class LatteLoaderFactory
{
    public function __invoke(ContainerInterface $container): FileLoader
    {
        $config = $container->get('config');

        return new FileLoader(
            $config['latte']['path'] ?? $config['templates']['paths'][''][0] ?? 'src/App/templates',
        );
    }
}
