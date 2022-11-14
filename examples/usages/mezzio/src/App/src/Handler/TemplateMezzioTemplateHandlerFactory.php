<?php

declare(strict_types=1);

namespace App\Handler;

use Psr\Container\ContainerInterface;
use Schranz\Templating\Adapter\MezzioTemplate\MezzioTemplateRenderer;

class TemplateMezzioTemplateHandlerFactory
{
    public function __invoke(ContainerInterface $container) : TemplateMezzioTemplateHandler
    {
        return new TemplateMezzioTemplateHandler($container->get(MezzioTemplateRenderer::class));
    }
}
