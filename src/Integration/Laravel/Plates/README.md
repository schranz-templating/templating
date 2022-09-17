# Schranz Template Renderer Integration for Plates

Integrate the templating [Plates Adapter](https://github.com/schranz-templating/plates-adapter) 
into the Laravel Framework.

Part of the [Schranz Templating Project](https://github.com/schranz-templating/templating).

## Installation

Install this package via Composer:

```bash
composer require schranz-templating/laravel-plates-integration
```

Depending on the projects setup maybe following need to be added to the `config/app.php`:

```php
    'providers' => [
        // ...
        Schranz\Templating\Integration\Laravel\Plates\SchranzTemplatingPlatesProvider::class,
    ],
```

## Configuration

The example and default configuration can be found in [config/schranz_templating_plates.php](config/schranz_templating_plates.php).
