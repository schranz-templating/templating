<?php

declare(strict_types=1);

namespace App\Handler;

use Psr\Container\ContainerInterface;
use Schranz\Templating\Adapter\Blade\BladeRenderer;

class TemplateBladeHandlerFactory
{
    public function __invoke(ContainerInterface $container) : TemplateBladeHandler
    {
        return new TemplateBladeHandler($container->get(BladeRenderer::class));
    }
}
