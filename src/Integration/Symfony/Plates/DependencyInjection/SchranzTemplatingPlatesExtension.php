<?php

namespace Schranz\Templating\Integration\Symfony\Plates\DependencyInjection;

use League\Plates\Engine;
use Schranz\Templating\Bridge\Plates\PlatesRenderer;
use Schranz\Templating\TemplateRenderer\TemplateRendererInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

/**
 * @internal
 */
class SchranzTemplatingPlatesExtension extends Extension
{
    public function getAlias(): string
    {
        return 'schranz_templating_plates';
    }

    /**
     * @return void
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $this->loadPlates($config, $container);

        $definition = new Definition(
            PlatesRenderer::class,
            [
                new Reference('plates'),
            ]
        );

        $container->setDefinition(
            'schranz_templating.renderer.plates',
            $definition
        );

        $container->setAlias(
            TemplateRendererInterface::class,
            'schranz_templating.renderer.plates'
        );

        $container->registerAliasForArgument(
            'schranz_templating.renderer.plates',
            TemplateRendererInterface::class,
            'platesRenderer'
        );
    }

    /**
     * @return void
     */
    private function loadPlates(array $config, ContainerBuilder $container)
    {
        $path = $config['default_path'];
        $paths = $config['paths'] ?: [];

        $platesDefinition = new Definition(
            Engine::class,
            [
                $path,
            ]
        );

        foreach ($paths as $directory => $name) {
            $platesDefinition->addMethodCall(
                'addFolder'.
                [$name, $directory]
            );
        }

        $container->setDefinition('plates', $platesDefinition);

        $container->setAlias(
            Engine::class,
            'plates'
        );
    }
}
