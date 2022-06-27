<?php

namespace Schranz\Templating\Integration\Symfony\Smarty\DependencyInjection;

use Schranz\Templating\Bridge\Smarty\SmartyRenderer;
use Schranz\Templating\TemplateRenderer\TemplateRendererInterface;
use Smarty;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

/**
 * @internal
 */
class SchranzTemplatingSmartyExtension extends Extension
{
    public function getAlias(): string
    {
        return 'schranz_templating_smarty';
    }

    /**
     * @return void
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $this->loadSmarty($config, $container);

        $definition = new Definition(
            SmartyRenderer::class,
            [
                new Reference('smarty'),
            ]
        );

        $container->setDefinition(
            'schranz_templating.renderer.smarty',
            $definition
        );

        $container->setAlias(
            TemplateRendererInterface::class,
            'schranz_templating.renderer.smarty'
        );

        $container->registerAliasForArgument(
            'schranz_templating.renderer.smarty',
            TemplateRendererInterface::class,
            'smartyRenderer'
        );
    }

    /**
     * @return void
     */
    private function loadSmarty(array $config, ContainerBuilder $container)
    {
        $path = $config['default_path'];
        $cache = $config['cache'];

        $container->setDefinition(
            'smarty',
            (new Definition(Smarty::class))
                ->addMethodCall('setTemplateDir', [$path])
                ->addMethodCall('setCompileDir', [$cache . '/compile'])
                ->addMethodCall('setCacheDir', [$cache . '/cache'])
        );
    }
}
