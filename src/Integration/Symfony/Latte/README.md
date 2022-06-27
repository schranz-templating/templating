# Schranz Template Renderer Integration for Latte

Integrate the templating [Latte Bridge](https://github.com/schranz-templating/latte-bridge) 
into the Symfony Framework.

Part of the [Schranz Templating Project](https://github.com/schranz-templating/templating).

## Installation

Install this package via Composer:

```bash
composer require schranz-templating/symfony-latte-integration
```

Register the Bundle class in your `config/bundles.php` or Kernel file:

```php
return [
    // ...
    Schranz\Templating\Integration\Symfony\Latte\SchranzTemplatingLatteBundle::class => ['all' => true],
];
```

## Configuration

The Latte Integration has the following configuration available:

```yaml
schranz_templating_latte:
    default_path: '%kernel.project_dir%/templates'
    cache: '%kernel.cache_dir%/latte'
```

None of the configuration is required.

### default_path

**type:** `string` **default:** `'%kernel.project_dir%/templates'`

The path to the directory where Symfony will look for the application Latte templates by default.

### cache

**type:** `string` **default:** `'%kernel.cache_dir%/latte'`

Before using the Latte templates to render some contents, they are compiled into regular PHP code. Compilation is a costly process, so the result is cached in the directory defined by this configuration option.
