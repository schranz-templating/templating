# Schranz Template Renderer Integration for Latte

Integrate the templating [Latte Adapter](https://github.com/schranz-templating/latte-adapter)
into the [Laminas Framework](https://getlaminas.org/).

Part of the [Schranz Templating Project](https://github.com/schranz-templating/templating).

## Installation

Install this package via Composer:

```bash
composer require schranz-templating/laminas-latte-integration
```

Add the module to the `config/modules.config.php.php`:

```php
return [
    // ...
    'Schranz\Templating\Integration\Laminas\Latte',
];
```

## Configuration

The example and default configuration can be found in [config/module.config.php](config/module.config.php).

## Extensions

To extend Latte functionality you can create a new service extending from `Latte\Extension`
the service need to be registered and its service name configured the `module.config.php`:

```php
return [
    // ...
    'schranz_templating_latte' => [
        'extensions' => [
            \App\Latte\MyExtension::class,
            // or
            'my_extension',
        ],
    ],
];
```
