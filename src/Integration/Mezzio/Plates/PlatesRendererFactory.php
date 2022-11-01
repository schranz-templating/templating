<?php

namespace Schranz\Templating\Integration\Mezzio\Plates;

use League\Plates\Engine;
use Psr\Container\ContainerInterface;
use Schranz\Templating\Adapter\Plates\PlatesRenderer;

class PlatesRendererFactory
{
    public function __invoke(ContainerInterface $container): PlatesRenderer
    {
        $environment = $container->get(Engine::class);

        return new PlatesRenderer($environment);
    }
}
