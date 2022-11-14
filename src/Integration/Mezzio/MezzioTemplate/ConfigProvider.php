<?php

namespace Schranz\Templating\Integration\Mezzio\MezzioTemplate;

use Schranz\Templating\Adapter\MezzioTemplate\MezzioTemplateRenderer;
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
                TemplateRendererInterface::class => MezzioTemplateRenderer::class,
                MezzioTemplateRenderer::class => 'schranz_templating.renderer.mezzio',
            ],
            'factories' => [
                'schranz_templating.renderer.mezzio' => MezzioTemplateRendererFactory::class,
            ],
        ];
    }
}
