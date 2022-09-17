<?php

namespace Schranz\Templating\Integration\Symfony\Twig\DependencyInjection;

use Schranz\Templating\Adapter\Twig\TwigRenderer;
use Schranz\Templating\Integration\Symfony\Blade\DependencyInjection\Configuration;
use Schranz\Templating\TemplateRenderer\TemplateRendererInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

/**
 * @internal
 */
class SchranzTemplatingTwigExtension extends Extension
{
    /**
     * @return void
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $definition = new Definition(
            TwigRenderer::class,
            [
                new Reference('twig'),
            ]
        );

        $container->setDefinition(
            'schranz_templating.renderer.twig',
            $definition
        );

        $container->setAlias(
            TemplateRendererInterface::class,
            'schranz_templating.renderer.twig'
        );

        $container->registerAliasForArgument(
            'schranz_templating.renderer.twig',
            TemplateRendererInterface::class,
            'twigRenderer'
        );
    }
}
