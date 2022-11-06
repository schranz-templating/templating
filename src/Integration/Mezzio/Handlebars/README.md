# Schranz Template Renderer Integration for Handlebars

Integrate the templating [Handlebars Adapter](https://github.com/schranz-templating/handlebars-adapter) 
into the Mezzio Framework.

Part of the [Schranz Templating Project](https://github.com/schranz-templating/templating).

## Installation

Install this package via Composer:

```bash
composer require schranz-templating/mezzio-handlebars-integration
```

Register the ConfigProvider class in your `config/config.php` if not already automatically
added by the framework:

```php
// ...

$aggregator = new ConfigAggregator([
    // ...
    \Schranz\Templating\Integration\Mezzio\Handlebars\ConfigProvider::class,
]);
```

## Configuration

The following configuration is available:

```php
class ConfigProvider
{
    public function __invoke(): array
    {
        return [
            'handlebars' => [
                'path' => 'src/App/templates',
                'cache_dir' => 'data/cache/handlebars',
            ],
        ];
    }
}
```
