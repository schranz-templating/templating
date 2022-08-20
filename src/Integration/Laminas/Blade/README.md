# Schranz Template Renderer Integration for Blade

Integrate the templating [Blade Bridge](https://github.com/schranz-templating/blade-bridge)
into the [Laminas Framework](https://getlaminas.org/).

Part of the [Schranz Templating Project](https://github.com/schranz-templating/templating).

## Installation

Install this package via Composer:

```bash
composer require schranz-templating/laminas-blade-integration
```

Add the module to the `config/modules.config.php.php`:

```php
return [
    // ...
    'Schranz\Templating\Integration\Laminas\Blade',
];
```

## Configuration

The example and default configuration can be found in [config/module.config.php](config/module.config.php).

## Extensions

To extend Blade functionality you can create a new service extending from `Blade\Extension`
the service need to be registered and its service name configured the `module.config.php`:

```php
return [
    // ...
    'schranz_templating_blade' => [
        'extensions' => [
            \App\Blade\MyExtension::class,
            // or
            'my_extension',
        ],
    ],
];
```
