# Schranz Template Renderer Integration for Smarty

Integrate the templating [Smarty Bridge](https://github.com/schranz-templating/smarty-bridge) 
into the Laravel Framework.

Part of the [Schranz Templating Project](https://github.com/schranz-templating/templating).

## Installation

Install this package via Composer:

```bash
composer require schranz-templating/laravel-smarty-integration
```

Depending on the projects setup maybe following need to be added to the `config/app.php`:

```php
    'providers' => [
        // ...
        Schranz\Templating\Integration\Laravel\Smarty\SchranzTemplatingSmartyProvider::class,
    ],
```

## Configuration

The example and default configuration can be found in [config/schranz_templating_smarty.php](config/schranz_templating_smarty.php).
