<?php

namespace Schranz\Templating\Integration\Laminas\LaminasView;

use Laminas\ModuleManager\Feature\ConfigProviderInterface;
use Laminas\ServiceManager\ServiceManager;
use Laminas\View\Renderer\RendererInterface;
use Schranz\Templating\Bridge\LaminasView\LaminasViewRenderer;
use Schranz\Templating\TemplateRenderer\TemplateRendererInterface;

class Module implements ConfigProviderInterface
{
    const MODULE_NAME = 'schranz_templating_laminas_view';

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getServiceConfig(): array
    {
        return [
            'factories' => [
                'schranz_templating.renderer.laminas_view' => function (ServiceManager $container) {
                    return new LaminasViewRenderer($container->get(RendererInterface::class));
                },
            ],
            'aliases' => [
                TemplateRendererInterface::class => 'schranz_templating.renderer.laminas_view',
                LaminasViewRenderer::class => 'schranz_templating.renderer.laminas_view',
            ],
        ];
    }
}
