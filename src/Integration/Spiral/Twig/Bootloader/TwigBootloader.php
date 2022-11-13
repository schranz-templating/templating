<?php

namespace Schranz\Templating\Integration\Spiral\Twig\Bootloader;

use Psr\Container\ContainerInterface;
use Schranz\Templating\Adapter\Twig\TwigRenderer;
use Schranz\Templating\TemplateRenderer\TemplateRendererInterface;
use Spiral\Core\BinderInterface;
use Spiral\Boot\Bootloader\Bootloader;
use Spiral\Twig\TwigEngine;
use Spiral\Views\ViewContext;
use Twig\Environment;

final class TwigBootloader extends Bootloader
{
    protected const DEPENDENCIES = [
        \Spiral\Twig\Bootloader\TwigBootloader::class,
    ];

    protected const SINGLETONS = [
        'twig' => Environment::class,
        'schranz_templating.renderer.twig' => TemplateRendererInterface::class,
        TemplateRendererInterface::class => TwigRenderer::class,
        TwigRenderer::class => TwigRenderer::class,
    ];

    public function boot(BinderInterface $binder): void
    {
        $binder->bindSingleton(Environment::class, static function (ContainerInterface $container): Environment {
            try {
                $twigEngine = $container->get(TwigEngine::class);
            } catch (\Throwable $e) {
                throw new \LogicException(
                    \sprintf('Expected "%s" to be registered in the view manager.', TwigEngine::class),
                    previous: $e
                );
            }

            return $twigEngine->getEnvironment(new ViewContext());
        });
    }
}
