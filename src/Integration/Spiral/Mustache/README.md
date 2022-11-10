# Schranz Template Renderer Integration for Mustache

Integrate the templating [Mustache Adapter](https://github.com/schranz-templating/mustache-adapter) 
into the Spiral Framework.

Part of the [Schranz Templating Project](https://github.com/schranz-templating/templating).

## Installation

Install this package via Composer:

```bash
composer require schranz-templating/spiral-mustache-integration
```

Register the Bootloader class in your `app/src/Application/Kernel.php` if not already automatically
added by the framework:

```php
class Kernel extends \Spiral\Framework\Kernel
{
    protected const LOAD = [
        // ...
        \Schranz\Templating\Integration\Spiral\Mustache\Bootloader\MustacheBootloader::class,
    ];
}
```

## Configuration

The integration provides the following configuration.

```php
// app/config/schranz_templating_mustache.php

declare(strict_types=1);

return [
    'path' => 'app/views',
    'cache_dir' => 'runtime/cache/cache',
];
```
