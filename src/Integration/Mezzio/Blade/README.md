# Schranz Template Renderer Integration for Blade

Integrate the templating [Blade Adapter](https://github.com/schranz-templating/blade-adapter) 
into the Mezzio Framework.

Part of the [Schranz Templating Project](https://github.com/schranz-templating/templating).

## Installation

Install this package via Composer:

```bash
composer require schranz-templating/mezzio-blade-integration
```

Register the ConfigProvider class in your `config/config.php` if not already automatically
added by the framework:

```php
// ...

$aggregator = new ConfigAggregator([
    // ...
    \Schranz\Templating\Integration\Mezzio\Blade\ConfigProvider::class,
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
            'blade' => [
                'paths' => 'src/App/templates',
                'cache_dir' => 'data/cache/blade',
            ],
        ];
    }
}
```
