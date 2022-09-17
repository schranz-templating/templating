<?php

namespace Schranz\Templating\Integration\Laravel\Latte;

use Illuminate\Support\ServiceProvider;
use Latte\Engine;
use Latte\Loaders\FileLoader;
use Schranz\Templating\Adapter\Latte\LatteRenderer;
use Schranz\Templating\TemplateRenderer\TemplateRendererInterface;

class SchranzTemplatingLatteProvider extends ServiceProvider
{
    /**
     * @internal
     */
    public function register(): void
    {
        $this->publishes([
            __DIR__ . '/config/schranz_templating_latte.php' => config_path('schranz_templating_latte.php'),
        ]);

        $this->mergeConfigFrom(__DIR__ . '/config/schranz_templating_latte.php', 'schranz_templating_latte');


        $this->app->singleton('latte.loader', function ($app) {
            $path = $app['config']['schranz_templating_latte']['path'];

            return new FileLoader($path);
        });

        $this->app->singleton('latte', function ($app) {
            $cache = $app['config']['schranz_templating_latte']['cache'];

            $engine = new Engine();
            $engine->setTempDirectory($cache);
            $engine->setLoader($app['latte.loader']);

            foreach ($app->tagged('latte.extension') as $latteExtension) {
                $engine->addExtension($latteExtension);
            }

            return $engine;
        });

        $this->app->singleton('schranz_templating.renderer.latte', function ($app) {
            return new LatteRenderer($app['latte']);
        });

        $this->app->alias('schranz_templating.renderer.latte', TemplateRendererInterface::class);
        $this->app->alias('schranz_templating.renderer.latte', LatteRenderer::class);
    }

    /**
     * @internal
     */
    public function provides(): array
    {
        return [
            'schranz_templating.renderer.latte',
            TemplateRendererInterface::class,
            LatteRenderer::class,
        ];
    }
}
