# Schranz Template Renderer Integration for Mustache

Integrate the templating [Mustache Bridge](https://github.com/schranz-templating/mustache-bridge) 
into the Laravel Framework.

Part of the [Schranz Templating Project](https://github.com/schranz-templating/templating).

## Installation

Install this package via Composer:

```bash
composer require schranz-templating/laravel-mustache-integration
```

Depending on the projects setup maybe following need to be added to the `config/app.php`:

```php
    'providers' => [
        // ...
        Schranz\Templating\Integration\Laravel\Mustache\SchranzTemplatingMustacheProvider::class,
    ],
```

## Configuration

The example and default configuration can be found in [config/schranz_templating_mustache.php](config/schranz_templating_mustache.php).
