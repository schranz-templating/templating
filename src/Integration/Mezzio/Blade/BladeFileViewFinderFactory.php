<?php

namespace Schranz\Templating\Integration\Mezzio\Blade;

use Illuminate\View\FileViewFinder;
use Psr\Container\ContainerInterface;

class BladeFileViewFinderFactory
{
    public function __invoke(ContainerInterface $container): FileViewFinder
    {
        $config = $container->get('config');

        $templatePaths = null;
        if (($config['blade']['paths'] ?? null) === null) {
            $templatePaths = $config['templates']['paths'];

            foreach ($templatePaths as $key => $value) {
                $templatePaths[$key] = $value[0] ?? 'src/App/templates' . ($key ? '/' . $key : '');
            }
        }

        return new FileViewFinder(
            $container->get('blade.filesystem'),
            $config['blade']['paths'] ?? $templatePaths ?? ['' => 'src/App/templates']
        );
    }
}
