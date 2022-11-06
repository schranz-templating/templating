<?php

namespace Schranz\Templating\Integration\Mezzio\Handlebars;

use Handlebars\Loader\FilesystemLoader;
use Psr\Container\ContainerInterface;

class HandlebarsLoaderFactory
{
    public function __invoke(ContainerInterface $container): FilesystemLoader
    {
        $config = $container->get('config');

        return new FilesystemLoader(
            $config['handlebars']['path'] ?? $config['templates']['paths'][''][0] ?? 'src/App/templates',
        );
    }
}
