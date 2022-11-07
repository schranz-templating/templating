<?php

namespace Schranz\Templating\Integration\Mezzio\Blade;

use Illuminate\View\Factory;
use Psr\Container\ContainerInterface;
use Schranz\Templating\Adapter\Blade\BladeRenderer;

class BladeRendererFactory
{
    public function __invoke(ContainerInterface $container): BladeRenderer
    {
        return new BladeRenderer($container->get(Factory::class));
    }
}
