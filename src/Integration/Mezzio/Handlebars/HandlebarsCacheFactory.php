<?php

namespace Schranz\Templating\Integration\Mezzio\Handlebars;

use Handlebars\Cache\Disk;
use Psr\Container\ContainerInterface;

class HandlebarsCacheFactory
{
    public function __invoke(ContainerInterface $container): Disk
    {
        $config = $container->get('config');

        return new Disk(
            $config['handlebars']['cache_dir'] ?? 'data/cache/handlebars',
        );
    }
}
