# Schranz Template Renderer Integration for Mustache

Integrate the templating [Mustache Adapter](https://github.com/schranz-templating/mustache-adapter) 
into the Mezzio Framework.

Part of the [Schranz Templating Project](https://github.com/schranz-templating/templating).

## Installation

Install this package via Composer:

```bash
composer require schranz-templating/mezzio-mustache-integration
```

Register the ConfigProvider class in your `config/config.php` if not already automatically
added by the framework:

```php
// ...

$aggregator = new ConfigAggregator([
    // ...
    \Schranz\Templating\Integration\Mezzio\Mustache\ConfigProvider::class,
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
            'mustache' => [
                'path' => 'src/App/templates',
                'cache_dir' => 'data/cache/mustache',
            ],
        ];
    }
}
```
