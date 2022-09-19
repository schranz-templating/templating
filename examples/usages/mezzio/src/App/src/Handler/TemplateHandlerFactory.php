<?php

declare(strict_types=1);

namespace App\Handler;

use Psr\Container\ContainerInterface;
use Schranz\Templating\TemplateRenderer\TemplateRendererInterface;

class TemplateHandlerFactory
{
    public function __invoke(ContainerInterface $container) : TemplateHandler
    {
        return new TemplateHandler($container->get(TemplateRendererInterface::class));
    }
}
