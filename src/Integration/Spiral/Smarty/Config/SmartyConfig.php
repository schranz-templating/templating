<?php

namespace Schranz\Templating\Integration\Spiral\Smarty\Config;

use Spiral\Core\InjectableConfig;

final class SmartyConfig extends InjectableConfig
{
    public const CONFIG = 'schranz_templating_smarty';

    protected array $config = [
        'paths' => [],
        'cache_dir' => null,
        'compile_dir' => null,
    ];

    /**
     * @return array<string, string>
     */
    public function getPaths(): array
    {
        return (array)($this->config['paths'] ?? []);
    }

    public function getCacheDir(): string
    {
        return (string)($this->config['cache_dir']);
    }

    public function getCompileDir(): string
    {
        return (string)($this->config['compile_dir']);
    }
}
