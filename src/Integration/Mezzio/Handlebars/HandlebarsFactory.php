<?php

namespace Schranz\Templating\Integration\Mezzio\Handlebars;

use Handlebars\Handlebars;
use Psr\Container\ContainerInterface;

class HandlebarsFactory
{
    public function __invoke(ContainerInterface $container): Handlebars
    {
        return new Handlebars(
            [
                'cache' => $container->get('handlebars.cache'),
                'loader' => $container->get('handlebars.filesystem_loader'),
            ],
        );
    }
}
