<?php

namespace Schranz\Templating\Integration\Symfony\Latte\DependencyInjection\CompilerPass;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * @internal
 */
class LatteExtensionCompilerPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        $latte = $container->getDefinition('latte');

        $taggedServices = $container->findTaggedServiceIds('latte.extension');

        foreach ($taggedServices as $id => $attributes) {
            $latte->addMethodCall('addExtension', [
                $container->getDefinition($id)
            ]);
        }
    }
}
