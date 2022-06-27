<?php

namespace Schranz\Templating\Integration\Symfony\Smarty\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * @internal
 */
class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('schranz_templating_smarty');
        $rootNode = $treeBuilder->getRootNode();

        $rootNode->children()
            ->scalarNode('cache')
                ->defaultValue('%kernel.cache_dir%/smarty')
            ->end()
            ->scalarNode('default_path')
                ->info('The default path used to load templates')
                ->defaultValue('%kernel.project_dir%/templates')
            ->end()
        ->end();

        return $treeBuilder;
    }
}
