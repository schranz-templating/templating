<?php

namespace Schranz\Templating\Integration\Laravel\Twig;

use Illuminate\Support\ServiceProvider;
use Schranz\Templating\Bridge\Twig\TwigRenderer;
use Schranz\Templating\TemplateRenderer\TemplateRendererInterface;
use Twig\Environment;
use Twig\Extension\DebugExtension;
use Twig\Loader\FilesystemLoader;

class SchranzTemplatingTwigProvider extends ServiceProvider
{
    /**
     * @internal
     */
    public function register(): void
    {
        $this->publishes([
            __DIR__ . '/config/schranz_templating_twig.php' => config_path('schranz_templating_twig.php'),
        ]);

        $this->mergeConfigFrom(__DIR__ . '/config/schranz_templating_twig.php', 'schranz_templating_twig');

        $this->app->singleton('twig.loader', function ($app) {
            $paths = $app['config']['schranz_templating_twig']['paths'];

            return new FilesystemLoader($paths, base_path());
        });

        $this->app->singleton('twig', function ($app) {
            $cache = $app['config']['schranz_templating_twig']['cache'];
            $strictVariables = $app['config']['schranz_templating_twig']['strict_variables'];
            $debug = $app['config']['schranz_templating_twig']['debug'];
            $optimizations = $app['config']['schranz_templating_twig']['optimizations'];

            $environment = new Environment(
                $app['twig.loader'],
                [
                    'debug' => $debug,
                    'cache' => $cache,
                    'strict_variables' => $strictVariables,
                    'optimizations' => $optimizations,
                ]
            );

            if ($debug) {
                $environment->addExtension(new DebugExtension());
            }

            foreach ($app->tagged('twig.extension') as $latteExtension) {
                $environment->addExtension($latteExtension);
            }

            return $environment;
        });

        $this->app->singleton('schranz_templating.renderer.twig', function ($app) {
            return new TwigRenderer($app['twig']);
        });

        $this->app->alias('schranz_templating.renderer.twig', TemplateRendererInterface::class);
        $this->app->alias('schranz_templating.renderer.twig', TwigRenderer::class);
    }

    /**
     * @internal
     */
    public function provides(): array
    {
        return [
            'schranz_templating.renderer.twig',
            TemplateRendererInterface::class,
            TwigRenderer::class,
        ];
    }
}
