# Schranz Template Renderer Integration for Mustache

Integrate the templating [Mustache Bridge](https://github.com/schranz-templating/mustache-bridge) 
into the Symfony Framework.

Part of the [Schranz Templating Project](https://github.com/schranz-templating/templating).

## Installation

Install this package via Composer:

```bash
composer require schranz-templating/symfony-mustache-integration
```

Register the Bundle class in your `config/bundles.php` or Kernel file:

```php
return [
    // ...
    Schranz\Templating\Integration\Symfony\Mustache\SchranzTemplatingMustacheBundle::class => ['all' => true],
];
```

## Configuration

The Mustache Integration has the following configuration available:

```yaml
schranz_templating_mustache:
    default_path: '%kernel.project_dir%/templates'
    cache: '%kernel.cache_dir%/mustache'
```

None of the configuration is required.

### default_path

**type:** `string` **default:** `'%kernel.project_dir%/templates'`

The path to the directory where Symfony will look for the application Mustache templates by default.

### cache

**type:** `string` **default:** `'%kernel.cache_dir%/mustache'`

Before using the Mustache templates to render some contents, they are compiled into regular PHP code. Compilation is a costly process, so the result is cached in the directory defined by this configuration option.
