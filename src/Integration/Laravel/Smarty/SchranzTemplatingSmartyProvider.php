<?php

namespace Schranz\Templating\Integration\Laravel\Smarty;

use Illuminate\Support\ServiceProvider;
use \Schranz\Templating\Bridge\Smarty\SmartyRenderer;
use Schranz\Templating\TemplateRenderer\TemplateRendererInterface;

class SchranzTemplatingSmartyProvider extends ServiceProvider
{
    /**
     * @internal
     */
    public function register(): void
    {
        $this->publishes([
            __DIR__ . '/config/schranz_templating_smarty.php' => config_path('schranz_templating_smarty.php'),
        ]);

        $this->mergeConfigFrom(__DIR__ . '/config/schranz_templating_smarty.php', 'schranz_templating_smarty');

        $this->app->singleton('smarty', function ($app) {
            $paths = $app['config']['schranz_templating_smarty']['paths'];
            $cache = $app['config']['schranz_templating_smarty']['cache'];
            $compile = $app['config']['schranz_templating_smarty']['compile'];

            $smarty = new \Smarty();
            $smarty->setTemplateDir($paths);
            $smarty->setCacheDir($cache);
            $smarty->setCompileDir($compile);

            return $smarty;
        });

        $this->app->singleton('schranz_templating.renderer.smarty', function ($app) {
            return new SmartyRenderer($app['smarty']);
        });

        $this->app->alias('schranz_templating.renderer.smarty', TemplateRendererInterface::class);
        $this->app->alias('schranz_templating.renderer.smarty', SmartyRenderer::class);
    }

    /**
     * @internal
     */
    public function provides(): array
    {
        return [
            'schranz_templating.renderer.smarty',
            TemplateRendererInterface::class,
            SmartyRenderer::class,
        ];
    }
}
