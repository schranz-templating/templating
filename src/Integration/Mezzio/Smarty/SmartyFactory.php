<?php

namespace Schranz\Templating\Integration\Mezzio\Smarty;

use Psr\Container\ContainerInterface;
use Smarty;

class SmartyFactory
{
    public function __invoke(ContainerInterface $container): Smarty
    {
        $config = $container->get('config');

        $templatePaths = null;
        if (($config['smarty']['paths'] ?? null) === null) {
            $templatePaths = $config['templates']['paths'];

            foreach ($templatePaths as $key => $value) {
                $templatePaths[$key] = $value[0] ?? 'src/App/templates' . ($key ? '/' . $key : '');
            }
        }

        $smarty = new Smarty();
        $smarty->setTemplateDir($config['smarty']['paths'] ?? $templatePaths ?? 'src/App/templates');
        $smarty->setCacheDir($config['smarty']['cache_dir'] ?? 'data/cache/smarty/cache');
        $smarty->setCompileDir($config['smarty']['cache_dir'] ?? 'data/cache/smarty/compile');

        return $smarty;
    }
}
