<?php

namespace Schranz\Templating\Integration\Mezzio\Smarty;

use Schranz\Templating\Adapter\Smarty\SmartyRenderer;
use Schranz\Templating\TemplateRenderer\TemplateRendererInterface;
use Smarty;

class ConfigProvider
{
    public function __invoke(): array
    {
        return [
            'dependencies' => $this->getDependencies(),
            'smarty' => [
                'paths' => null,
                'cache_dir' => null,
                'compile_dir' => null,
            ],
        ];
    }

    public function getDependencies(): array
    {
        return [
            'aliases' => [
                TemplateRendererInterface::class => SmartyRenderer::class,
                SmartyRenderer::class => 'schranz_templating.renderer.smarty',
                Smarty::class => 'smarty',
            ],
            'factories' => [
                'smarty' => SmartyFactory::class,
                'schranz_templating.renderer.smarty' => SmartyRendererFactory::class,
            ],
        ];
    }
}
