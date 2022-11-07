<?php

declare(strict_types=1);

namespace App\Handler;

use Psr\Container\ContainerInterface;
use Schranz\Templating\Adapter\Mezzio\MezzioRenderer;

class TemplateMezzioHandlerFactory
{
    public function __invoke(ContainerInterface $container) : TemplateMezzioHandler
    {
        return new TemplateMezzioHandler($container->get(MezzioRenderer::class));
    }
}
