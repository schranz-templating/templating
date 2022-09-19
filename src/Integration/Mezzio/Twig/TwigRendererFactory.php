<?php

namespace Schranz\Templating\Integration\Mezzio\Twig;

use Psr\Container\ContainerInterface;
use Schranz\Templating\Adapter\Twig\TwigRenderer;
use Twig\Environment;

class TwigRendererFactory
{
    public function __invoke(ContainerInterface $container): TwigRenderer
    {
        $environment = $container->get(Environment::class);

        return new TwigRenderer($environment);
    }
}
