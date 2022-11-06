<?php

namespace Schranz\Templating\Integration\Mezzio\Handlebars;

use Handlebars\Handlebars;
use Schranz\Templating\Adapter\Handlebars\HandlebarsRenderer;
use Schranz\Templating\TemplateRenderer\TemplateRendererInterface;

class ConfigProvider
{
    public function __invoke(): array
    {
        return [
            'dependencies' => $this->getDependencies(),
            'handlebars' => [
                'path' => null,
                'cache_dir' => null,
            ],
        ];
    }

    public function getDependencies(): array
    {
        return [
            'aliases'   => [
                TemplateRendererInterface::class => HandlebarsRenderer::class,
                HandlebarsRenderer::class => 'schranz_templating.renderer.handlebars',
                Handlebars::class => 'handlebars',
            ],
            'factories' => [
                'handlebars.filesystem_loader' => HandlebarsLoaderFactory::class,
                'handlebars.cache' => HandlebarsCacheFactory::class,
                'handlebars' => HandlebarsFactory::class,
                'schranz_templating.renderer.handlebars' => HandlebarsRendererFactory::class,
            ],
        ];
    }
}
