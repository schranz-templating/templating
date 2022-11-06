<?php

namespace Schranz\Templating\Integration\Mezzio\Handlebars;

use Handlebars\Handlebars;
use Psr\Container\ContainerInterface;
use Schranz\Templating\Adapter\Handlebars\HandlebarsRenderer;

class HandlebarsRendererFactory
{
    public function __invoke(ContainerInterface $container): HandlebarsRenderer
    {
        return new HandlebarsRenderer($container->get(Handlebars::class));
    }
}
