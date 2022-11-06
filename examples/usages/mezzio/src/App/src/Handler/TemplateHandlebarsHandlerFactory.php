<?php

declare(strict_types=1);

namespace App\Handler;

use Psr\Container\ContainerInterface;
use Schranz\Templating\Adapter\Handlebars\HandlebarsRenderer;

class TemplateHandlebarsHandlerFactory
{
    public function __invoke(ContainerInterface $container) : TemplateHandlebarsHandler
    {
        return new TemplateHandlebarsHandler($container->get(HandlebarsRenderer::class));
    }
}
