<?php

namespace Schranz\Templating\Integration\Spiral\SpiralView\Bootloader;

use Schranz\Templating\Adapter\SpiralView\SpiralViewRenderer;
use Schranz\Templating\TemplateRenderer\TemplateRendererInterface;
use Spiral\Boot\Bootloader\Bootloader;
use Spiral\Core\Container;
use Spiral\Views\Engine\Native\NativeEngine;
use Spiral\Views\ViewManager;

final class SpiralViewBootloader extends Bootloader
{
    public function boot(Container $container): void
    {
        $container->bindSingleton('schranz_templating.renderer.spiral_view', function (Container $container) {
            $viewManager = $container->get(ViewManager::class);

            $engines = $viewManager->getEngines();

            $nativeEngine = null;
            foreach ($engines as $nativeEngine) {
                if ($nativeEngine instanceof NativeEngine) {
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

        $container->bind(TemplateRendererInterface::class, 'schranz_templating.renderer.spiral_view');
        $container->bind(SpiralViewRenderer::class, 'schranz_templating.renderer.spiral_view');
    }
}
