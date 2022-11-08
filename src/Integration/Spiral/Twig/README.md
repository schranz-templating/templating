# Schranz Template Renderer Integration for Twig

Integrate the templating [Twig Adapter](https://github.com/schranz-templating/twig-adapter) 
into the Spiral Framework.

Part of the [Schranz Templating Project](https://github.com/schranz-templating/templating).

## Installation

Install this package via Composer:

```bash
composer require schranz-templating/spiral-twig-integration
```

Register the Bootloader class in your `app/src/Application/Kernel.php` if not already automatically
added by the framework:

```php
class Kernel extends \Spiral\Framework\Kernel
{
    protected const LOAD = [
        // ...
        \Spiral\Twig\Bootloader\TwigBootloader::class,
        \Schranz\Templating\Integration\Spiral\Twig\Bootloader\TwigBootloader::class,
    ];
}
```

## Configuration

The Twig Integration has currently no configuration as Twig
is supported out of the box by Spiral and can be configured
via the [Spiral Twig Views](https://spiral.dev/docs/views-twig).
