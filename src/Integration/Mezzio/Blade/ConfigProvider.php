<?php

namespace Schranz\Templating\Integration\Mezzio\Blade;

use Illuminate\View\Factory;
use Schranz\Templating\Adapter\Blade\BladeRenderer;
use Schranz\Templating\TemplateRenderer\TemplateRendererInterface;

class ConfigProvider
{
    public function __invoke(): array
    {
        return [
            'dependencies' => $this->getDependencies(),
            'blade' => [
                'paths' => null,
                'cache_dir' => null,
            ],
        ];
    }

    public function getDependencies(): array
    {
        return [
            'aliases' => [
                TemplateRendererInterface::class => BladeRenderer::class,
                BladeRenderer::class => 'schranz_templating.renderer.blade',
                Factory::class => 'blade',
            ],
            'factories' => [
                'blade.filesystem' => BladeFilesystemFactory::class,
                'blade.compiler' => BladeCompilerFactory::class,
                'blade.file_view_finder' => BladeFileViewFinderFactory::class,
                /* php closure not used when using blade for rendering but could be used this way
                'blade.blade.engine_resolver_php_closure' => BladeEngineResolverPHPClosureFactory::class,
                */
                'blade.engine_resolver_blade_closure' => BladeEngineResolverBladeClosureFactory::class,
                'blade.engine_resolver' => BladeEngineResolverFactory::class,
                'blade.dispatcher' => BladeDispatcherFactory::class,
                'blade' => BladeFactory::class,
                'schranz_templating.renderer.blade' => BladeRendererFactory::class,
            ],
        ];
    }
}
