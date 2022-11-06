<?php

namespace Schranz\Templating\Integration\Mezzio\Mustache;

use Mustache_Loader_FilesystemLoader;
use Psr\Container\ContainerInterface;

class MustacheLoaderFactory
{
    public function __invoke(ContainerInterface $container): Mustache_Loader_FilesystemLoader
    {
        $config = $container->get('config');

        return new Mustache_Loader_FilesystemLoader(
            $config['mustache']['path'] ?? $config['templates']['paths'][''][0] ?? 'src/App/templates',
        );
    }
}
