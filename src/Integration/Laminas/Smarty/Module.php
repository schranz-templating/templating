<?php

namespace Schranz\Templating\Integration\Laminas\Smarty;

use Laminas\ModuleManager\Feature\ConfigProviderInterface;
use Laminas\ServiceManager\ServiceManager;
use Schranz\Templating\Adapter\Smarty\SmartyRenderer;
use Schranz\Templating\TemplateRenderer\TemplateRendererInterface;

class Module implements ConfigProviderInterface
{
    const MODULE_NAME = 'schranz_templating_smarty';

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getServiceConfig(): array
    {
        return [
            'factories' => [
                'smarty' => function (ServiceManager $container) {
                    $smarty = new \Smarty();
                    $smarty->setTemplateDir($container->get('config')[self::MODULE_NAME]['paths']);
                    $smarty->setCacheDir($container->get('config')[self::MODULE_NAME]['cache']);
                    $smarty->setCompileDir($container->get('config')[self::MODULE_NAME]['compile']);

                    return $smarty;
                },
                'schranz_templating.renderer.smarty' => function (ServiceManager $container) {
                    return new SmartyRenderer($container->get('smarty'));
                },
            ],
            'aliases' => [
                TemplateRendererInterface::class => 'schranz_templating.renderer.smarty',
                SmartyRenderer::class => 'schranz_templating.renderer.smarty',
            ],
        ];
    }
}
