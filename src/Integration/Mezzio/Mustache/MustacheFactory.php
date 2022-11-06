<?php

namespace Schranz\Templating\Integration\Mezzio\Mustache;

use Mustache_Engine;
use Psr\Container\ContainerInterface;

class MustacheFactory
{
    public function __invoke(ContainerInterface $container): Mustache_Engine
    {
        $config = $container->get('config');

        return new Mustache_Engine(
            [
                'cache' => $config['mustache']['cache_dir'] ?? 'data/cache/mustache',
                'loader' => $container->get('mustache.filesystem_loader'),
                'charset' => 'UTF-8',
            ]
        );
    }
}
