<?php

namespace Schranz\Templating\Integration\Spiral\Handlebars\Config;

use Spiral\Core\InjectableConfig;

final class HandlebarsConfig extends InjectableConfig
{
    public const CONFIG = 'schranz_templating_handlebars';

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
