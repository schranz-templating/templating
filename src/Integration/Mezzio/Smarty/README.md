# Schranz Template Renderer Integration for Smarty

Integrate the templating [Smarty Adapter](https://github.com/schranz-templating/smarty-adapter) 
into the Mezzio Framework.

Part of the [Schranz Templating Project](https://github.com/schranz-templating/templating).

## Installation

Install this package via Composer:

```bash
composer require schranz-templating/mezzio-smarty-integration
```

Register the ConfigProvider class in your `config/config.php` if not already automatically
added by the framework:

```php
// ...

$aggregator = new ConfigAggregator([
    // ...
    \Schranz\Templating\Integration\Mezzio\Smarty\ConfigProvider::class,
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
            'smarty' => [
                'paths' => ['src/App/templates'],
                'cache_dir' => 'data/cache/smarty/cache',
                'compile_dir' => 'data/cache/smarty/compile',
            ],
        ];
    }
}
```
