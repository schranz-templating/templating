<?php

declare(strict_types=1);

namespace App\Handler;

use Psr\Container\ContainerInterface;
use Schranz\Templating\Adapter\Plates\PlatesRenderer;

class TemplatePlatesHandlerFactory
{
    public function __invoke(ContainerInterface $container) : TemplatePlatesHandler
    {
        return new TemplatePlatesHandler($container->get(PlatesRenderer::class));
    }
}
