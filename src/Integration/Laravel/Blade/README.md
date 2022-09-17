# Schranz Template Renderer Integration for Blade

Integrate the templating [Blade Adapter](https://github.com/schranz-templating/blade-adapter) 
into the Laravel Framework.

Part of the [Schranz Templating Project](https://github.com/schranz-templating/templating).

## Installation

Install this package via Composer:

```bash
composer require schranz-templating/laravel-blade-integration
```

Depending on the projects setup maybe following need to be added to the `config/app.php`:

```php
    'providers' => [
        // ...
        Schranz\Templating\Integration\Laravel\Blade\SchranzTemplatingBladeProvider::class,
    ],
```

## Configuration

The Blade Integration has currently no configuration as Blade
is supported out of the box by Laravel and can be configured
via the [Laravel Blade Integration](https://laravel.com/docs/9.x/blade).
