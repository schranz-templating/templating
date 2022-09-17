# Schranz Template Renderer Integration for Mustache

Integrate the templating [Mustache Adapter](https://github.com/schranz-templating/mustache-adapter)
into the [Laminas Framework](https://getlaminas.org/).

Part of the [Schranz Templating Project](https://github.com/schranz-templating/templating).

## Installation

Install this package via Composer:

```bash
composer require schranz-templating/laminas-mustache-integration
```

Add the module to the `config/modules.config.php.php`:

```php
return [
    // ...
    'Schranz\Templating\Integration\Laminas\Mustache',
];
```

## Configuration

The example and default configuration can be found in [config/module.config.php](config/module.config.php).
