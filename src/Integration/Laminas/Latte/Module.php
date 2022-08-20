<?php

namespace Schranz\Templating\Integration\Laminas\Latte;

use Laminas\ModuleManager\Feature\ConfigProviderInterface;
use Laminas\ServiceManager\ServiceManager;
use Latte\Engine;
use Latte\Loaders\FileLoader;
use Schranz\Templating\Bridge\Latte\LatteRenderer;
use Schranz\Templating\TemplateRenderer\TemplateRendererInterface;

class Module implements ConfigProviderInterface
{
    const MODULE_NAME = 'schranz_templating_latte';

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getServiceConfig(): array
    {
        return [
            'factories' => [
                'latte.loader' => function (ServiceManager $container) {
                    return new FileLoader(
                        $container->get('config')[self::MODULE_NAME]['path'],
                    );
                },
                'latte' => function (ServiceManager $container) {
                    $engine = new Engine();
                    $engine->setTempDirectory($container->get('config')[self::MODULE_NAME]['cache']);
                    $engine->setLoader($container->get('latte.loader'));

                    foreach ($container->get('config')[self::MODULE_NAME]['extensions'] as $latteExtension) {
                        if (is_string($latteExtension)) {
                            $latteExtension = $container->get($latteExtension);
                        }

                        $engine->addExtension($container->get($latteExtension));
                    }

                    return $engine;
                },
                'schranz_templating.renderer.latte' => function (ServiceManager $container) {
                    return new LatteRenderer($container->get('latte'));
                },
            ],
            'aliases' => [
                TemplateRendererInterface::class => 'schranz_templating.renderer.latte',
                LatteRenderer::class => 'schranz_templating.renderer.latte',
            ],
        ];
    }
}
