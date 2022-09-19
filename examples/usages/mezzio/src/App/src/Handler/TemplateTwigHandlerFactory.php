<?php

declare(strict_types=1);

namespace App\Handler;

use Psr\Container\ContainerInterface;
use Schranz\Templating\Adapter\Twig\TwigRenderer;

class TemplateTwigHandlerFactory
{
    public function __invoke(ContainerInterface $container) : TemplateTwigHandler
    {
        return new TemplateTwigHandler($container->get(TwigRenderer::class));
    }
}
