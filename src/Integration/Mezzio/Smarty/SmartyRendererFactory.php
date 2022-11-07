<?php

namespace Schranz\Templating\Integration\Mezzio\Smarty;

use Smarty;
use Psr\Container\ContainerInterface;
use Schranz\Templating\Adapter\Smarty\SmartyRenderer;

class SmartyRendererFactory
{
    public function __invoke(ContainerInterface $container): SmartyRenderer
    {
        return new SmartyRenderer($container->get(Smarty::class));
    }
}
