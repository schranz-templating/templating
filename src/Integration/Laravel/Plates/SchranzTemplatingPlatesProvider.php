<?php

namespace Schranz\Templating\Integration\Laravel\Plates;

use Illuminate\Support\ServiceProvider;
use League\Plates\Engine;
use Schranz\Templating\Bridge\Plates\PlatesRenderer;
use Schranz\Templating\TemplateRenderer\TemplateRendererInterface;

class SchranzTemplatingPlatesProvider extends ServiceProvider
{
    /**
     * @internal
     */
    public function register(): void
    {
        $this->publishes([
            __DIR__ . '/config/schranz_templating_plates.php' => config_path('schranz_templating_plates.php'),
        ]);

        $this->mergeConfigFrom(__DIR__ . '/config/schranz_templating_plates.php', 'schranz_templating_plates');

        $this->app->singleton('plates', function ($app) {
            $paths = $app['config']['schranz_templating_plates']['paths'];

            $engine = new Engine(
                $paths[0],
            );

            unset($paths[0]);
            foreach ($paths as $path) {
                $engine->addFolder($path);
            }

            return $engine;
        });

        $this->app->singleton('schranz_templating.renderer.plates', function ($app) {
            return new PlatesRenderer($app['plates']);
        });

        $this->app->alias('schranz_templating.renderer.plates', TemplateRendererInterface::class);
        $this->app->alias('schranz_templating.renderer.plates', PlatesRenderer::class);
    }

    /**
     * @internal
     */
    public function provides(): array
    {
        return [
            'schranz_templating.renderer.plates',
            TemplateRendererInterface::class,
            PlatesRenderer::class,
        ];
    }
}
