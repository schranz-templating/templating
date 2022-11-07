<?php

namespace Schranz\Templating\Integration\Mezzio\Latte;

use Latte\Engine;
use Schranz\Templating\Adapter\Latte\LatteRenderer;
use Schranz\Templating\TemplateRenderer\TemplateRendererInterface;

class ConfigProvider
{
    public function __invoke(): array
    {
        return [
            'dependencies' => $this->getDependencies(),
            'latte' => [
                'path' => null,
                'cache_dir' => null,
                'extensions' => [],
            ],
        ];
    }

    public function getDependencies(): array
    {
        return [
            'aliases' => [
                TemplateRendererInterface::class => LatteRenderer::class,
                LatteRenderer::class => 'schranz_templating.renderer.latte',
                Engine::class => 'latte',
            ],
            'factories' => [
                'latte.loader' => LatteLoaderFactory::class,
                'latte' => LatteFactory::class,
                'schranz_templating.renderer.latte' => LatteRendererFactory::class,
            ],
        ];
    }
}
