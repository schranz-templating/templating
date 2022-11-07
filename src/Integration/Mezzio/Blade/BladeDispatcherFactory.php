<?php

namespace Schranz\Templating\Integration\Mezzio\Blade;

use Illuminate\Events\Dispatcher;
use Psr\Container\ContainerInterface;

class BladeDispatcherFactory
{
    public function __invoke(ContainerInterface $container): Dispatcher
    {
        return new Dispatcher();
    }
}
