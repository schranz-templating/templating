<?php

namespace Schranz\Templating\Integration\Mezzio\Mustache;

use Mustache_Engine;
use Schranz\Templating\Adapter\Mustache\MustacheRenderer;
use Schranz\Templating\TemplateRenderer\TemplateRendererInterface;

class ConfigProvider
{
    public function __invoke(): array
    {
        return [
            'dependencies' => $this->getDependencies(),
            'mustache' => [
                'path' => null,
                'cache_dir' => null,
            ],
        ];
    }

    public function getDependencies(): array
    {
        return [
            'aliases' => [
                TemplateRendererInterface::class => MustacheRenderer::class,
                MustacheRenderer::class => 'schranz_templating.renderer.mustache',
                Mustache_Engine::class => 'mustache',
            ],
            'factories' => [
                'mustache.filesystem_loader' => MustacheLoaderFactory::class,
                'mustache' => MustacheFactory::class,
                'schranz_templating.renderer.mustache' => MustacheRendererFactory::class,
            ],
        ];
    }
}
