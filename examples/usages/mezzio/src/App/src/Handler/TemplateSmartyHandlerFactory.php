<?php

declare(strict_types=1);

namespace App\Handler;

use Psr\Container\ContainerInterface;
use Schranz\Templating\Adapter\Smarty\SmartyRenderer;

class TemplateSmartyHandlerFactory
{
    public function __invoke(ContainerInterface $container) : TemplateSmartyHandler
    {
        return new TemplateSmartyHandler($container->get(SmartyRenderer::class));
    }
}
