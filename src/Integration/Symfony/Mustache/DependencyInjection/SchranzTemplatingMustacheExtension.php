<?php

namespace Schranz\Templating\Integration\Symfony\Mustache\DependencyInjection;

use Mustache_Engine;
use Mustache_Loader_FilesystemLoader;
use Schranz\Templating\Adapter\Mustache\MustacheRenderer;
use Schranz\Templating\TemplateRenderer\TemplateRendererInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

/**
 * @internal
 */
class SchranzTemplatingMustacheExtension extends Extension
{
    public function getAlias(): string
    {
        return 'schranz_templating_mustache';
    }

    /**
     * @return void
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $this->loadMustache($config, $container);

        $definition = new Definition(
            MustacheRenderer::class,
            [
                new Reference('mustache'),
            ]
        );

        $container->setDefinition(
            'schranz_templating.renderer.mustache',
            $definition
        );

        $container->setAlias(
            TemplateRendererInterface::class,
            'schranz_templating.renderer.mustache'
        );

        $container->registerAliasForArgument(
            'schranz_templating.renderer.mustache',
            TemplateRendererInterface::class,
            'mustacheRenderer'
        );
    }

    /**
     * @return void
     */
    private function loadMustache(array $config, ContainerBuilder $container)
    {
        $path = $config['default_path'];
        $cache = $config['cache'];

        $container->setDefinition(
            'mustache.filesystem_loader',
            new Definition(Mustache_Loader_FilesystemLoader::class, [
                $path,
            ])
        );

        $container->setDefinition(
            'mustache',
            new Definition(Mustache_Engine::class, [
                [
                    'cache' => $cache,
                    'loader' => new Reference('mustache.filesystem_loader'),
                    'charset' => 'UTF-8',
                ]
            ])
        );
    }
}
