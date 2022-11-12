# Schranz Template Renderer Integration for SpiralView

Integrate the templating [SpiralView Adapter](https://github.com/schranz-templating/spiral-view-adapter) 
into the Spiral Framework.

Part of the [Schranz Templating Project](https://github.com/schranz-templating/templating).

## Installation

Install this package via Composer:

```bash
composer require schranz-templating/spiral-spiral-view-integration
```

Register the Bootloader class in your `app/src/Application/Kernel.php` if not already automatically
added by the framework:

```php
class Kernel extends \Spiral\Framework\Kernel
{
    protected const LOAD = [
        // ...
        \Spiral\Views\Bootloader\ViewsBootloader::class,
        \Schranz\Templating\Integration\Spiral\SpiralView\Bootloader\SpiralViewBootloader::class,
    ];
}
```

## Configuration

The Spiral View Integration has currently no configuration as LSpiralView
is supported out of the box by Spiral and can be configured
via the [Spiral View Configuration](https://spiral.dev/docs/views-configuration).
