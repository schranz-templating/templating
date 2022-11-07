<?php

namespace Schranz\Templating\Integration\Mezzio\Blade;

use Illuminate\Filesystem\Filesystem;
use Psr\Container\ContainerInterface;

class BladeFilesystemFactory
{
    public function __invoke(ContainerInterface $container): Filesystem
    {
        return new Filesystem();
    }
}
