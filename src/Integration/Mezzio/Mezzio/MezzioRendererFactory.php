<?php

namespace Schranz\Templating\Integration\Mezzio\Mezzio;

use Psr\Container\ContainerInterface;
use Schranz\Templating\Adapter\Mezzio\MezzioRenderer;
use Mezzio\Template\TemplateRendererInterface as MezzioTemplateRendererInterface;

class MezzioRendererFactory
{
    public function __invoke(ContainerInterface $container): MezzioRenderer
    {
        return new MezzioRenderer($container->get(MezzioTemplateRendererInterface::class));
    }
}
