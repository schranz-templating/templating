<?php

namespace Schranz\Templating\Integration\Spiral\Twig\Bootloader;

use Schranz\Templating\Adapter\Twig\TwigRenderer;
use Schranz\Templating\TemplateRenderer\TemplateRendererInterface;
use Spiral\Core\Container;
use Spiral\Boot\Bootloader\Bootloader;
use Spiral\Twig\TwigEngine;
use Spiral\Views\ViewContext;
use Spiral\Views\ViewManager;
use Twig\Environment;

final class TwigBootloader extends Bootloader
{
    public function boot(Container $container): void
    {
        $container->bindSingleton('twig', function (Container $container) {
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

        $container->bind(Environment::class, 'twig');

        $container->bindSingleton('schranz_templating.renderer.twig', function (Container $container) {
            return new TwigRenderer($container->get('twig'));
        });

        $container->bind(TemplateRendererInterface::class, 'schranz_templating.renderer.twig');
        $container->bind(TwigRenderer::class, 'schranz_templating.renderer.twig');

        $container->bindSingleton('schranz_templating.renderer.twig', function (Container $container) {
            return new TwigRenderer($container->get('twig'));
        });
    }
}
