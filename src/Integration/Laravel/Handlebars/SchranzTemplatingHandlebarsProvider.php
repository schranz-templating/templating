<?php

namespace Schranz\Templating\Integration\Laravel\Handlebars;

use Handlebars\Cache\Disk;
use Handlebars\Handlebars;
use Handlebars\Loader\FilesystemLoader;
use Illuminate\Support\ServiceProvider;
use Schranz\Templating\Adapter\Handlebars\HandlebarsRenderer;
use Schranz\Templating\TemplateRenderer\TemplateRendererInterface;

class SchranzTemplatingHandlebarsProvider extends ServiceProvider
{
    /**
     * @internal
     */
    public function register(): void
    {
        $this->publishes([
            __DIR__ . '/config/schranz_templating_handlebars.php' => config_path('schranz_templating_handlebars.php'),
        ]);

        $this->mergeConfigFrom(__DIR__ . '/config/schranz_templating_handlebars.php', 'schranz_templating_handlebars');

        $this->app->singleton('handlebars.filesystem_loader', function ($app) {
            return new FilesystemLoader(
                $app['config']['schranz_templating_handlebars']['path'],
            );
        });

        $this->app->singleton('handlebars.cache', function ($app) {
            return new Disk(
                $app['config']['schranz_templating_handlebars']['cache'],
            );
        });

        $this->app->singleton('handlebars', function ($app) {
            return new Handlebars(
                [
                    'cache' => $app['handlebars.cache'],
                    'loader' => $app['handlebars.filesystem_loader'],
                ]
            );
        });

        $this->app->singleton('schranz_templating.renderer.handlebars', function ($app) {
            return new HandlebarsRenderer($app['handlebars']);
        });

        $this->app->alias('schranz_templating.renderer.handlebars', TemplateRendererInterface::class);
        $this->app->alias('schranz_templating.renderer.handlebars', HandlebarsRenderer::class);
    }

    /**
     * @internal
     */
    public function provides(): array
    {
        return [
            'schranz_templating.renderer.handlebars',
            TemplateRendererInterface::class,
            HandlebarsRenderer::class,
        ];
    }
}
