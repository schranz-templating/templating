<?php

declare(strict_types=1);

namespace App\Handler;

use Psr\Container\ContainerInterface;
use Schranz\Templating\Adapter\Mustache\MustacheRenderer;

class TemplateMustacheHandlerFactory
{
    public function __invoke(ContainerInterface $container) : TemplateMustacheHandler
    {
        return new TemplateMustacheHandler($container->get(MustacheRenderer::class));
    }
}
