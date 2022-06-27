<?php

namespace Schranz\Templating\Integration\Symfony\Latte\DependencyInjection;

use Latte\Engine;
use Latte\Loaders\FileLoader;
use Schranz\Templating\Bridge\Latte\LatteRenderer;
use Schranz\Templating\TemplateRenderer\TemplateRendererInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

/**
 * @internal
 */
class SchranzTemplatingLatteExtension extends Extension
{
    public function getAlias(): string
    {
        return 'schranz_templating_latte';
    }

    /**
     * @return void
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $this->loadLatte($config, $container);

        $definition = new Definition(
            LatteRenderer::class,
            [
                new Reference('latte'),
            ]
        );

        $container->setDefinition(
            'schranz_templating.renderer.latte',
            $definition
        );

        $container->setAlias(
            TemplateRendererInterface::class,
            'schranz_templating.renderer.latte'
        );

        $container->registerAliasForArgument(
            'schranz_templating.renderer.latte',
            TemplateRendererInterface::class,
            'latteRenderer'
        );
    }

    /**
     * @return void
     */
    private function loadLatte(array $config, ContainerBuilder $container)
    {
        $baseDir = $config['default_path'];
        $cache = $config['cache'];

        $container->setDefinition(
            'latte.file_loader',
            new Definition(FileLoader::class, [$baseDir])
        );

        $container->setDefinition(
            'latte',
            (new Definition(Engine::class))
                ->addMethodCall('setTempDirectory', [$cache])
                ->addMethodCall('setLoader', [new Reference('latte.file_loader')])
        );
    }
}
