# Schranz Template Renderer Integration for Mezzio

Integrate the templating [Mezzio Template Adapter](https://github.com/schranz-templating/mezzio-template-adapter) 
into the Mezzio Framework.

Part of the [Schranz Templating Project](https://github.com/schranz-templating/templating).

## Installation

Install this package via Composer:

```bash
composer require schranz-templating/mezzio-mezzio-template-integration
```

Register the ConfigProvider class in your `config/config.php` if not already automatically
added by the framework:

```php
// ...

$aggregator = new ConfigAggregator([
    // ...
    \Schranz\Templating\Integration\Mezzio\MezzioTemplate\ConfigProvider::class,
]);
```

## Configuration

The Mezzio Integration has currently no configuration as Plates
is supported out of the box by Mezzio and can be configured
via one of the following integrations:

 - [Plates Renderer](https://docs.mezzio.dev/mezzio/v3/features/template/plates/)
 - [Twig Renderer](https://docs.mezzio.dev/mezzio/v3/features/template/twig/)
 - [Laminas View Renderer](https://docs.mezzio.dev/mezzio/v3/features/template/laminas-view/)
