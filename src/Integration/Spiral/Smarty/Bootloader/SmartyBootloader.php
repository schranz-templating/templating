<?php

namespace Schranz\Templating\Integration\Spiral\Smarty\Bootloader;

use Schranz\Templating\Adapter\Smarty\SmartyRenderer;
use Schranz\Templating\Integration\Spiral\Smarty\Config\SmartyConfig;
use Schranz\Templating\TemplateRenderer\TemplateRendererInterface;
use Smarty;
use Spiral\Boot\Bootloader\Bootloader;
use Spiral\Core\Container;
use Spiral\Config\ConfiguratorInterface;

final class SmartyBootloader extends Bootloader
{
    public function __construct(
        private readonly ConfiguratorInterface $config
    ) {
    }

    public function init(): void {
        $this->config->setDefaults(
            SmartyConfig::CONFIG,
            [
                'paths' => [
                    'hello' => 'app/views',
                ],
                'cache_dir' => 'runtime/cache/smarty/cache',
                'compile_dir' => 'runtime/cache/smarty/compile',
            ]
        );
    }

    public function boot(Container $container): void
    {
        $container->bindSingleton('smarty', function (Container $container) {
            $config = $container->get(SmartyConfig::class);

            $smarty = new Smarty();
            $smarty->setTemplateDir($config->getPaths());
            $smarty->setCacheDir($config->getCacheDir());
            $smarty->setCompileDir($config->getCompileDir());

            return $smarty;
        });

        $container->bind(Smarty::class, 'smarty');

        $container->bindSingleton('schranz_templating.renderer.smarty', function (Container $container) {
            return new SmartyRenderer($container->get('smarty'));
        });

        $container->bind(TemplateRendererInterface::class, 'schranz_templating.renderer.smarty');
        $container->bind(SmartyRenderer::class, 'schranz_templating.renderer.smarty');
    }
}
