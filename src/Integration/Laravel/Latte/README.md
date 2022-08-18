# Schranz Template Renderer Integration for Latte

Integrate the templating [Latte Bridge](https://github.com/schranz-templating/latte-bridge) 
into the Laravel Framework.

Part of the [Schranz Templating Project](https://github.com/schranz-templating/templating).

## Installation

Install this package via Composer:

```bash
composer require schranz-templating/laravel-latte-integration
```

Depending on the projects setup maybe following need to be added to the `config/app.php`:

```php
    'providers' => [
        // ...
        Schranz\Templating\Integration\Laravel\Latte\SchranzTemplatingLatteProvider::class,
    ],
```

## Configuration

The example and default configuration can be found in [config/schranz_templating_latte.php](config/schranz_templating_latte.php).

## Extensions

To extend Latte functionality you can create a new service extending from `Latte\Extension`
the service need to be tagged with `latte.extension` to be registered as Latte Extension:

```php
$app->tag(\App\Latte\MyExtension::class, 'latte.extension');
```

Read more about Latte Extensions in the [Latte documentation](https://latte.nette.org/en/creating-extension).
