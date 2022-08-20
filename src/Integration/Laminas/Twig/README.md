# Schranz Template Renderer Integration for Twig

Integrate the templating [Twig Bridge](https://github.com/schranz-templating/twig-bridge)
into the [Laminas Framework](https://getlaminas.org/).

Part of the [Schranz Templating Project](https://github.com/schranz-templating/templating).

## Installation

Install this package via Composer:

```bash
composer require schranz-templating/laminas-twig-integration
```

Add the module to the `config/modules.config.php.php`:

```php
return [
    // ...
    'Schranz\Templating\Integration\Laminas\Twig',
];
```

## Configuration

The example and default configuration can be found in [config/module.config.php](config/module.config.php).

## Extensions

To extend Twig functionality you can create a new service extending from `Twig\Extension`
the service need to be registered and its service name configured the `module.config.php`:

```php
return [
    // ...
    'schranz_templating_twig' => [
        'extensions' => [
            \App\Twig\MyExtension::class,
            // or
            'my_extension',
        ],
    ],
];
```
