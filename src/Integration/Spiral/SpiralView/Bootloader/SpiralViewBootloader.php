<?php

namespace Schranz\Templating\Integration\Spiral\SpiralView\Bootloader;

use Psr\Container\ContainerInterface;
use Schranz\Templating\Adapter\SpiralView\SpiralViewRenderer;
use Schranz\Templating\TemplateRenderer\TemplateRendererInterface;
use Spiral\Boot\Bootloader\Bootloader;
use Spiral\Core\BinderInterface;
use Spiral\Twig\TwigEngine;
use Spiral\Views\Engine\Native\NativeEngine;
use Spiral\Views\ViewContext;
use Spiral\Views\ViewManager;
use Twig\Environment;

final class SpiralViewBootloader extends Bootloader
{
    protected const DEPENDENCIES = [
        \Spiral\Views\Bootloader\ViewsBootloader::class
    ];

    protected const SINGLETONS = [
        'schranz_templating.renderer.spiral_view' => TemplateRendererInterface::class,
        TemplateRendererInterface::class => SpiralViewRenderer::class,
    ];

    public function boot(BinderInterface $binder): void
    {
        // Use a hack to get Twig from the ViewManager as it is not available as an service yet
        $binder->bindSingleton(SpiralViewRenderer::class, function (ContainerInterface $container) {
            // Use a hack to get Twig from the ViewManager as it is not available as an service yet
            $viewManager = $container->get(ViewManager::class);

            $engines = $viewManager->getEngines();

            $nativeEngine = null;
            foreach ($engines as $engine) {
                if ($engine instanceof NativeEngine) {
                    $nativeEngine = $engine;
                    break;
                }
            }

            if (null === $nativeEngine) {
                throw new \LogicException(
                    \sprintf('Expected "%s" to be registered in the view manager.', NativeEngine::class)
                );
            }

            return new SpiralViewRenderer($nativeEngine);
        });
    }
}
