<?php

namespace Schranz\Templating\Integration\Spiral\Plates\Config;

use Spiral\Core\InjectableConfig;

final class PlatesConfig extends InjectableConfig
{
    public const CONFIG = 'schranz_templating_plates';

    protected array $config = [
        'paths' => [],
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
}
