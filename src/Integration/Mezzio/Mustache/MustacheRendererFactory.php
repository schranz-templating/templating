<?php

namespace Schranz\Templating\Integration\Mezzio\Mustache;

use Mustache_Engine;
use Psr\Container\ContainerInterface;
use Schranz\Templating\Adapter\Mustache\MustacheRenderer;

class MustacheRendererFactory
{
    public function __invoke(ContainerInterface $container): MustacheRenderer
    {
        return new MustacheRenderer($container->get(Mustache_Engine::class));
    }
}
