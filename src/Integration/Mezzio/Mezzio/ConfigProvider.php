<?php

namespace Schranz\Templating\Integration\Mezzio\Mezzio;

use Schranz\Templating\Adapter\Mezzio\MezzioRenderer;
use Schranz\Templating\TemplateRenderer\TemplateRendererInterface;

class ConfigProvider
{
    public function __invoke(): array
    {
        return [
            'dependencies' => $this->getDependencies(),
        ];
    }

    public function getDependencies(): array
    {
        return [
            'aliases' => [
                TemplateRendererInterface::class => MezzioRenderer::class,
                MezzioRenderer::class => 'schranz_templating.renderer.mezzio',
            ],
            'factories' => [
                'schranz_templating.renderer.mezzio' => MezzioRendererFactory::class,
            ],
        ];
    }
}
