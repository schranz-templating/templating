# Schranz Template Renderer Integration for Handlebars

Integrate the templating [Handlebars Bridge](https://github.com/schranz-templating/handlebars-bridge) 
into the Laravel Framework.

Part of the [Schranz Templating Project](https://github.com/schranz-templating/templating).

## Installation

Install this package via Composer:

```bash
composer require schranz-templating/laravel-handlebars-integration
```

Depending on the projects setup maybe following need to be added to the `config/app.php`:

```php
    'providers' => [
        // ...
        Schranz\Templating\Integration\Laravel\Handlebars\SchranzTemplatingHandlebarsProvider::class,
    ],
```

## Configuration

The example and default configuration can be found in [config/schranz_templating_handlebars.php](config/schranz_templating_handlebars.php).
