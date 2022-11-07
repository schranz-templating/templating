<?php

namespace Schranz\Templating\Integration\Mezzio\Latte;

use Latte\Engine;
use Psr\Container\ContainerInterface;

class LatteFactory
{
    public function __invoke(ContainerInterface $container): Engine
    {
        $config = $container->get('config');

        $engine = new Engine();
        $engine->setTempDirectory($config['latte']['cache_dir'] ?? 'data/cache/latte');
        $engine->setLoader($container->get('latte.loader'));

        foreach ($config['latte']['extensions'] as $latteExtension) {
            if (is_string($latteExtension)) {
                $latteExtension = $container->get($latteExtension);
            }

            $engine->addExtension($container->get($latteExtension));
        }

        return $engine;
    }
}
