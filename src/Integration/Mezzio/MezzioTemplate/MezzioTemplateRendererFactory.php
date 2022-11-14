<?php

namespace Schranz\Templating\Integration\Mezzio\MezzioTemplate;

use Psr\Container\ContainerInterface;
use Schranz\Templating\Adapter\MezzioTemplate\MezzioTemplateRenderer;
use Mezzio\Template\TemplateRendererInterface as MezzioTemplateRendererInterface;

class MezzioTemplateRendererFactory
{
    public function __invoke(ContainerInterface $container): MezzioTemplateRenderer
    {
        return new MezzioTemplateRenderer($container->get(MezzioTemplateRendererInterface::class));
    }
}
