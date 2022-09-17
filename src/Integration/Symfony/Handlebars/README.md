# Schranz Template Renderer Integration for Handlebars

Integrate the templating [Handlebars Adapter](https://github.com/schranz-templating/handlebars-adapter) 
into the Symfony Framework.

Part of the [Schranz Templating Project](https://github.com/schranz-templating/templating).

## Installation

Install this package via Composer:

```bash
composer require schranz-templating/symfony-handlebars-integration
```

Register the Bundle class in your `config/bundles.php` or Kernel file:

```php
return [
    // ...
    Schranz\Templating\Integration\Symfony\Handlebars\SchranzTemplatingHandlebarsBundle::class => ['all' => true],
];
```

## Configuration

The Handlebars Integration has the following configuration available:

```yaml
schranz_templating_handlebars:
    default_path: '%kernel.project_dir%/templates'
    cache: '%kernel.cache_dir%/handlebars'
```

None of the configuration is required.

### default_path

**type:** `string` **default:** `'%kernel.project_dir%/templates'`

The path to the directory where Symfony will look for the application Handlebars templates by default.

### cache

**type:** `string` **default:** `'%kernel.cache_dir%/handlebars'`

Before using the Handlebars templates to render some contents, they are compiled into regular PHP code. Compilation is a costly process, so the result is cached in the directory defined by this configuration option.
