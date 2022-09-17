# Schranz Template Renderer Integration for LaminasView

Integrate the templating [LaminasView Adapter](https://github.com/schranz-templating/laminas-view-adapter)
into the [Laminas Framework](https://getlaminas.org/).

Part of the [Schranz Templating Project](https://github.com/schranz-templating/templating).

## Installation

Install this package via Composer:

```bash
composer require schranz-templating/laminas-laminas-view-integration
```

Add the module to the `config/modules.config.php.php`:

```php
return [
    // ...
    'Schranz\Templating\Integration\Laminas\LaminasView',
];
```

## Configuration

The Laminas View Integration has currently no configuration as LaminasView
is supported out of the box by Laminas and can be configured
via the [Laminas View Module](https://docs.laminas.dev/laminas-view/).
