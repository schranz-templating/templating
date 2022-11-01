<?php

namespace Schranz\Templating\Integration\Mezzio\Plates;

use Schranz\Templating\Adapter\Plates\PlatesRenderer;
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
            'aliases'   => [
                TemplateRendererInterface::class => PlatesRenderer::class,
                PlatesRenderer::class => 'schranz_templating.renderer.plates',
            ],
            'factories' => [
                'schranz_templating.renderer.plates' => PlatesRendererFactory::class,
            ],
        ];
    }
}
