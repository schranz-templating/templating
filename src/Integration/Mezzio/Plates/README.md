# Schranz Template Renderer Integration for Plates

Integrate the templating [Plates Adapter](https://github.com/schranz-templating/plates-adapter) 
into the Mezzio Framework.

Part of the [Schranz Templating Project](https://github.com/schranz-templating/templating).

## Installation

Install this package via Composer:

```bash
composer require schranz-templating/mezzio-plates-integration
```

Register the ConfigProvider class in your `config/config.php` if not already automatically
added by the framework:

```php
// ...

$aggregator = new ConfigAggregator([
    // ...
    \Mezzio\Plates\ConfigProvider::class,
    \Schranz\Templating\Integration\Mezzio\Plates\ConfigProvider::class,
]);
```

## Configuration

The Plates Integration has currently no configuration as Plates
is supported out of the box by Mezzio and can be configured
via the [Mezzio Plates Renderer](https://docs.mezzio.dev/mezzio/v3/features/template/plates/).

## Usage with other Mezzio renderer

To use it side by side with other Mezzio renderer integrations you need configure the extension
of the files:

```php
// src/App/src/ConfigProvider.php

class ConfigProvider
{
    public function __invoke(): array
    {
        return [
            // ...
            'plates' => [
                'extension' => 'php',
            ],
        ];
    }
}
```
