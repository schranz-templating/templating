<?php

namespace Schranz\Templating\Integration\Symfony\Plates\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * @internal
 */
class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('schranz_templating_plates');
        $rootNode = $treeBuilder->getRootNode();

        $rootNode->children()
            ->scalarNode('default_path')
                ->info('The default path used to load templates')
                ->defaultValue('%kernel.project_dir%/templates')
            ->end()
            ->arrayNode('paths')
                ->normalizeKeys(false)
                ->useAttributeAsKey('paths')
                ->beforeNormalization()
                    ->always()
                    ->then(function ($paths) {
                        $normalized = [];
                        foreach ($paths as $path => $namespace) {
                            if (\is_array($namespace)) {
                                // xml
                                $path = $namespace['value'];
                                $namespace = $namespace['namespace'];
                            }

                            // path within the default namespace
                            if (ctype_digit((string) $path)) {
                                $path = $namespace;
                                $namespace = null;
                            }

                            $normalized[$path] = $namespace;
                        }

                        return $normalized;
                    })
                ->end()
                ->prototype('variable')->end()
            ->end()
        ->end();

        return $treeBuilder;
    }
}
