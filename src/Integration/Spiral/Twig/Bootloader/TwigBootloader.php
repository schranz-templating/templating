<?php

namespace Schranz\Templating\Integration\Spiral\Twig\Bootloader;

use Psr\Container\ContainerInterface;
use Schranz\Templating\Adapter\Twig\TwigRenderer;
use Schranz\Templating\TemplateRenderer\TemplateRendererInterface;
use Spiral\Core\BinderInterface;
use Spiral\Boot\Bootloader\Bootloader;
use Spiral\Twig\TwigEngine;
use Spiral\Views\ViewContext;
use Spiral\Views\ViewManager;
use Twig\Environment;

final class TwigBootloader extends Bootloader
{
    protected const DEPENDENCIES = [
        \Spiral\Twig\Bootloader\TwigBootloader::class,
    ];

    protected const SINGLETONS = [
        TemplateRendererInterface::class => TwigRenderer::class,
        TwigRenderer::class => TwigRenderer::class,
    ];

    public function boot(BinderInterface $binder): void
    {
        // Use a hack to get Twig from the ViewManager as it is not available as an service yet
        $binder->bindSingleton(Environment::class, function (ContainerInterface $container) {
            // Use a hack to get Twig from the ViewManager as it is not available as an service yet
            $viewManager = $container->get(ViewManager::class);

            $engines = $viewManager->getEngines();

            $twigEngine = null;
            foreach ($engines as $engine) {
                if ($engine instanceof TwigEngine) {
                    $twigEngine = $engine;
                    break;
                }
            }

            if (null === $twigEngine) {
                throw new \LogicException(
                    \sprintf('Expected "%s" to be registered in the view manager.', TwigEngine::class)
                );
            }

            return $twigEngine->getEnvironment(new ViewContext());
        });
    }
}
