<?php

namespace Schranz\Templating\Integration\Mezzio\Blade;

use Illuminate\View\Factory;
use Psr\Container\ContainerInterface;

class BladeFactory
{
    public function __invoke(ContainerInterface $container): Factory
    {
        return new Factory(
            $container->get('blade.engine_resolver'),
            $container->get('blade.file_view_finder'),
            $container->get('blade.dispatcher'),
        );
    }
}
