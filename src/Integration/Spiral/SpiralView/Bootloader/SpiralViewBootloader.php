<?php

namespace Schranz\Templating\Integration\Spiral\SpiralView\Bootloader;

use Psr\Container\ContainerInterface;
use Schranz\Templating\Adapter\SpiralView\SpiralViewRenderer;
use Schranz\Templating\TemplateRenderer\TemplateRendererInterface;
use Spiral\Boot\Bootloader\Bootloader;
use Spiral\Core\BinderInterface;
use Spiral\Views\Engine\Native\NativeEngine;

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
        $binder->bindSingleton(SpiralViewRenderer::class, function (ContainerInterface $container) {
            try {
                $nativeEngine = $container->get(NativeEngine::class);
            } catch (\Throwable $e) {
                throw new \LogicException(
                    \sprintf('Expected "%s" to be registered in the view manager.', NativeEngine::class),
                    previous: $e
                );
            }

            return new SpiralViewRenderer($nativeEngine);
        });
    }
}
