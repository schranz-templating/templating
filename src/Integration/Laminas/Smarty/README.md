# Schranz Template Renderer Integration for Smarty

Integrate the templating [Smarty Adapter](https://github.com/schranz-templating/smarty-adapter)
into the [Laminas Framework](https://getlaminas.org/).

Part of the [Schranz Templating Project](https://github.com/schranz-templating/templating).

## Installation

Install this package via Composer:

```bash
composer require schranz-templating/laminas-smarty-integration
```

Add the module to the `config/modules.config.php.php`:

```php
return [
    // ...
    'Schranz\Templating\Integration\Laminas\Smarty',
];
```

## Configuration

The example and default configuration can be found in [config/module.config.php](config/module.config.php).
