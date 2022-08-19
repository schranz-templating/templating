# Schranz Template Renderer Integration for Handlebars

Integrate the templating [Handlebars Bridge](https://github.com/schranz-templating/handlebars-bridge)
into the [Laminas Framework](https://getlaminas.org/).

Part of the [Schranz Templating Project](https://github.com/schranz-templating/templating).

## Installation

Install this package via Composer:

```bash
composer require schranz-templating/laminas-handlebars-integration
```

Add the module to the `config/modules.config.php.php`:

```php
return [
    // ...
    'Schranz\Templating\Integration\Laminas\Handlebars',
];
```

## Configuration

The example and default configuration can be found in [config/module.config.php](config/module.config.php).
