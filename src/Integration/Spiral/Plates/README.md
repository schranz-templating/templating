# Schranz Template Renderer Integration for Plates

Integrate the templating [Plates Adapter](https://github.com/schranz-templating/plates-adapter) 
into the Spiral Framework.

Part of the [Schranz Templating Project](https://github.com/schranz-templating/templating).

## Installation

Install this package via Composer:

```bash
composer require schranz-templating/spiral-plates-integration
```

Register the Bootloader class in your `app/src/Application/Kernel.php` if not already automatically
added by the framework:

```php
class Kernel extends \Spiral\Framework\Kernel
{
    protected const LOAD = [
        // ...
        \Schranz\Templating\Integration\Spiral\Plates\Bootloader\PlatesBootloader::class,
    ];
}
```

## Configuration

The integration provides the following configuration.

```php
// app/config/schranz_templating_plates.php

declare(strict_types=1);

return [
    'paths' => [
        'app/views'
    ],
];
```
