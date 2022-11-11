<?php

namespace Schranz\Templating\Integration\Spiral\Latte\Config;

use Spiral\Core\InjectableConfig;

final class LatteConfig extends InjectableConfig
{
    public const CONFIG = 'schranz_templating_latte';

    protected array $config = [
        'path' => null,
        'cache_dir' => null,
    ];

    public function getPath(): string
    {
        return (string)($this->config['path']);
    }

    public function getCacheDir(): string
    {
        return (string)($this->config['cache_dir']);
    }
}
