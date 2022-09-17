<?php

namespace Schranz\Templating\Integration\Laravel\Mustache;

use Illuminate\Support\ServiceProvider;
use Schranz\Templating\Adapter\Mustache\MustacheRenderer;
use Schranz\Templating\TemplateRenderer\TemplateRendererInterface;

class SchranzTemplatingMustacheProvider extends ServiceProvider
{
    /**
     * @internal
     */
    public function register(): void
    {
        $this->publishes([
            __DIR__ . '/config/schranz_templating_mustache.php' => config_path('schranz_templating_mustache.php'),
        ]);

        $this->mergeConfigFrom(__DIR__ . '/config/schranz_templating_mustache.php', 'schranz_templating_mustache');

        $this->app->singleton('mustache.filesystem_loader', function ($app) {
            return new \Mustache_Loader_FilesystemLoader(
                $app['config']['schranz_templating_mustache']['path'] ?? resource_path('views'),
            );
        });

        $this->app->singleton('mustache', function ($app) {
            return new \Mustache_Engine([
                'cache' => $app['config']['schranz_templating_mustache']['cache'],
                'loader' => $app['mustache.filesystem_loader'],
                'charset' => 'UTF-8',
            ]);
        });

        $this->app->singleton('schranz_templating.renderer.mustache', function ($app) {
            return new MustacheRenderer($app['mustache']);
        });

        $this->app->alias('schranz_templating.renderer.mustache', TemplateRendererInterface::class);
        $this->app->alias('schranz_templating.renderer.mustache', MustacheRenderer::class);
    }

    /**
     * @internal
     */
    public function provides(): array
    {
        return [
            'schranz_templating.renderer.mustache',
            TemplateRendererInterface::class,
            MustacheRenderer::class,
        ];
    }
}
