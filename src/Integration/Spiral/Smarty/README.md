# Schranz Template Renderer Integration for Smarty

Integrate the templating [Smarty Adapter](https://github.com/schranz-templating/smarty-adapter) 
into the Spiral Framework.

Part of the [Schranz Templating Project](https://github.com/schranz-templating/templating).

## Installation

Install this package via Composer:

```bash
composer require schranz-templating/spiral-smarty-integration
```

Register the Bootloader class in your `app/src/Application/Kernel.php` if not already automatically
added by the framework:

```php
class Kernel extends \Spiral\Framework\Kernel
{
    protected const LOAD = [
        // ...
        \Schranz\Templating\Integration\Spiral\Smarty\Bootloader\SmartyBootloader::class,
    ];
}
```

## Configuration

The Smarty Integration has currently no configuration as Smarty
is supported out of the box by Spiral and can be configured
via the [Spiral Smarty Views](https://spiral.dev/docs/views-smarty).
