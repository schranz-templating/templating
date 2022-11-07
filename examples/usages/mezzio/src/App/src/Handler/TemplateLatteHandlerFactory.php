<?php

declare(strict_types=1);

namespace App\Handler;

use Psr\Container\ContainerInterface;
use Schranz\Templating\Adapter\Latte\LatteRenderer;

class TemplateLatteHandlerFactory
{
    public function __invoke(ContainerInterface $container) : TemplateLatteHandler
    {
        return new TemplateLatteHandler($container->get(LatteRenderer::class));
    }
}
