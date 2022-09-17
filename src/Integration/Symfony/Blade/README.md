# Schranz Template Renderer Integration for Blade

Integrate the templating [Blade Adapter](https://github.com/schranz-templating/blade-adapter) 
into the Symfony Framework.

Part of the [Schranz Templating Project](https://github.com/schranz-templating/templating).

## Installation

Install this package via Composer:

```bash
composer require schranz-templating/symfony-blade-integration
```

Register the Bundle class in your `config/bundles.php` or Kernel file:

```php
return [
    // ...
    Schranz\Templating\Integration\Symfony\Blade\SchranzTemplatingBladeBundle::class => ['all' => true],
];
```

## Configuration

The Blade Integration has the following configuration available:

```yaml
schranz_templating_blade:
    default_path: '%kernel.project_dir%/templates'
    paths: []
    cache: '%kernel.cache_dir%/blade'
```

None of the configuration is required.

### default_path

**type:** `string` **default:** `'%kernel.project_dir%/templates'`

The path to the directory where Symfony will look for the application Blade templates by default.
If you store the templates in more than one directory, use the paths option too.

### paths

**type:** `array` **default:** `[]`

```yaml
schranz_templating_blade:
    paths:
        'email/default/templates': ~
        'backend/templates': 'admin'
```

Defines the directories where application templates are stored in addition to the directory defined in the [`default_path`](#default_path) option:

### cache

**type:** `string` **default:** `'%kernel.cache_dir%/blade'`

Before using the Blade templates to render some contents, they are compiled into regular PHP code. Compilation is a costly process, so the result is cached in the directory defined by this configuration option.
