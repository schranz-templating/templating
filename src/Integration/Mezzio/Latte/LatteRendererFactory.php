<?php

namespace Schranz\Templating\Integration\Mezzio\Latte;

use Latte\Engine;
use Psr\Container\ContainerInterface;
use Schranz\Templating\Adapter\Latte\LatteRenderer;

class LatteRendererFactory
{
    public function __invoke(ContainerInterface $container): LatteRenderer
    {
        return new LatteRenderer($container->get(Engine::class));
    }
}
