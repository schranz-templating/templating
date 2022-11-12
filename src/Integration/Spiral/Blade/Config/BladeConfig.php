<?php

namespace Schranz\Templating\Integration\Spiral\Blade\Config;

use Spiral\Core\InjectableConfig;

final class BladeConfig extends InjectableConfig
{
    public const CONFIG = 'schranz_templating_blade';

    protected array $config = [
        'paths' => [],
        'cache_dir' => null,
    ];

    public function getPath(): string
    {
        return (string)($this->config['path']);
    }

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
}
