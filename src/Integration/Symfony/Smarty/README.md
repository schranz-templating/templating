# Schranz Template Renderer Integration for Smarty

Integrate the templating [Smarty Adapter](https://github.com/schranz-templating/smarty-adapter) 
into the Symfony Framework.

Part of the [Schranz Templating Project](https://github.com/schranz-templating/templating).

## Installation

Install this package via Composer:

```bash
composer require schranz-templating/symfony-smarty-integration
```

Register the Bundle class in your `config/bundles.php` or Kernel file:

```php
return [
    // ...
    Schranz\Templating\Integration\Symfony\Smarty\SchranzTemplatingMustacheBundle::class => ['all' => true],
];
```

## Configuration

The Smarty Integration has the following configuration available:

```yaml
schranz_templating_smarty:
    default_path: '%kernel.project_dir%/templates'
    cache: '%kernel.cache_dir%/smarty'
```

None of the configuration is required.

### default_path

**type:** `string` **default:** `'%kernel.project_dir%/templates'`

The path to the directory where Symfony will look for the application Smarty templates by default.

### cache

**type:** `string` **default:** `'%kernel.cache_dir%/smarty'`

Before using the Smarty templates to render some contents, they are compiled into regular PHP code. Compilation is a costly process, so the result is cached in the directory defined by this configuration option.
