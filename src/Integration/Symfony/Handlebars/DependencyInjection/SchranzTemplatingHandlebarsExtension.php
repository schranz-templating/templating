<?php

namespace Schranz\Templating\Integration\Symfony\Handlebars\DependencyInjection;

use Handlebars\Cache\Disk;
use Handlebars\Handlebars;
use Handlebars\Loader\FilesystemLoader;
use Schranz\Templating\Adapter\Handlebars\HandlebarsRenderer;
use Schranz\Templating\TemplateRenderer\TemplateRendererInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

/**
 * @internal
 */
class SchranzTemplatingHandlebarsExtension extends Extension
{
    public function getAlias(): string
    {
        return 'schranz_templating_handlebars';
    }

    /**
     * @return void
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $this->loadHandlebars($config, $container);

        $definition = new Definition(
            HandlebarsRenderer::class,
            [
                new Reference('handlebars'),
            ]
        );

        $container->setDefinition(
            'schranz_templating.renderer.handlebars',
            $definition
        );

        $container->setAlias(
            TemplateRendererInterface::class,
            'schranz_templating.renderer.handlebars'
        );

        $container->registerAliasForArgument(
            'schranz_templating.renderer.handlebars',
            TemplateRendererInterface::class,
            'handlebarsRenderer'
        );
    }

    /**
     * @return void
     */
    private function loadHandlebars(array $config, ContainerBuilder $container)
    {
        $path = $config['default_path'];
        $cache = $config['cache'];

        $container->setDefinition(
            'handlebars.filesystem_loader',
            new Definition(FilesystemLoader::class, [
                $path,
            ])
        );

        $container->setDefinition(
            'handlebars.cache',
            new Definition(Disk::class, [
                $cache,
            ])
        );

        $container->setDefinition(
            'handlebars',
            new Definition(Handlebars::class, [
                [
                    'cache' => new Reference('handlebars.cache'),
                    'loader' => new Reference('handlebars.filesystem_loader'),
                ]
            ])
        );
    }
}
