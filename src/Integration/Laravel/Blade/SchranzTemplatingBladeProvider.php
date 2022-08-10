<?php

namespace Schranz\Templating\Integration\Laravel\Blade;

use Illuminate\Support\ServiceProvider;
use Schranz\Templating\Bridge\Blade\BladeRenderer;
use Schranz\Templating\TemplateRenderer\TemplateRendererInterface;

class SchranzTemplatingBladeProvider extends ServiceProvider
{
    /**
     * @internal
     */
    public function register(): void
    {
        $this->app->singleton('schranz_templating.renderer.blade', function ($app) {
            return new BladeRenderer($app['view']);
        });

        $this->app->alias('schranz_templating.renderer.blade', TemplateRendererInterface::class);
        $this->app->alias('schranz_templating.renderer.blade', BladeRenderer::class);
    }

    /**
     * @internal
     */
    public function provides(): array
    {
        return [
            'schranz_templating.renderer.blade',
            TemplateRendererInterface::class,
            BladeRenderer::class,
        ];
    }
}
