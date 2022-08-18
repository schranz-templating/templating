# Schranz Template Renderer Integration for Twig

Integrate the templating [Twig Bridge](https://github.com/schranz-templating/twig-bridge) 
into the Laravel Framework.

Part of the [Schranz Templating Project](https://github.com/schranz-templating/templating).

## Installation

Install this package via Composer:

```bash
composer require schranz-templating/laravel-twig-integration
```

Depending on the projects setup maybe following need to be added to the `config/app.php`:

```php
    'providers' => [
        // ...
        Schranz\Templating\Integration\Laravel\Twig\SchranzTemplatingTwigProvider::class,
    ],
```

## Configuration

The example and default configuration can be found in [config/schranz_templating_twig.php](config/schranz_templating_twig.php).

## Extensions

To extend Twig functionality you can create a new service implementing the `Twig\Extension\ExtensionInterface`,
the service need to be tagged with `twig.extension` to be registered as Twig Extension:

```php
$app->tag(\App\Twig\MyExtension::class, 'twig.extension');
```

Read more about Twig Extensions in the [Twig documentation](https://twig.symfony.com/doc/3.x/advanced.html#creating-an-extension).
