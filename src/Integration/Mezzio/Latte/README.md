# Schranz Template Renderer Integration for Latte

Integrate the templating [Latte Adapter](https://github.com/schranz-templating/latte-adapter) 
into the Mezzio Framework.

Part of the [Schranz Templating Project](https://github.com/schranz-templating/templating).

## Installation

Install this package via Composer:

```bash
composer require schranz-templating/mezzio-latte-integration
```

Register the ConfigProvider class in your `config/config.php` if not already automatically
added by the framework:

```php
// ...

$aggregator = new ConfigAggregator([
    // ...
    \Schranz\Templating\Integration\Mezzio\Latte\ConfigProvider::class,
]);
```

## Configuration

The following configuration is available:

```php
// src/App/src/ConfigProvider.php

class ConfigProvider
{
    public function __invoke(): array
    {
        return [
            // ...
            'latte' => [
                'path' => 'src/App/templates',
                'cache_dir' => 'data/cache/latte',
                'extensions' => [
                    \App\Latte\MyExtension::class,
                    // or
                    'my_extension',
                ],
            ],
        ];
    }
}
```
