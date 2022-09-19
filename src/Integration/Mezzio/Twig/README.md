# Schranz Template Renderer Integration for Twig

Integrate the templating [Twig Adapter](https://github.com/schranz-templating/twig-adapter) 
into the Mezzio Framework.

Part of the [Schranz Templating Project](https://github.com/schranz-templating/templating).

## Installation

Install this package via Composer:

```bash
composer require schranz-templating/mezzio-twig-integration
```

Register the ConfigProvider class in your `config/config.php` if not already automatically
added by the framework:

```php
// ...

$aggregator = new ConfigAggregator([
    // ...
    \Mezzio\Twig\ConfigProvider::class,
    \Schranz\Templating\Integration\Mezzio\Twig\ConfigProvider::class,
]);
```

## Configuration

The Twig Integration has currently no configuration as twig
is supported out of the box by Mezzio and can be configured
via the [Mezzio Twig Renderer](https://docs.mezzio.dev/mezzio/v3/features/template/twig/).
