# Schranz Template Renderer Integration for Twig

Integrate the templating [Twig Adapter](https://github.com/schranz-templating/twig-adapter) 
into the Symfony Framework.

Part of the [Schranz Templating Project](https://github.com/schranz-templating/templating).

## Installation

Install this package via Composer:

```bash
composer require schranz-templating/symfony-twig-integration
```

Register the Bundle class in your `config/bundles.php` or Kernel file:

```php
return [
    // ...
    Schranz\Templating\Integration\Symfony\Twig\SchranzTemplatingTwigBundle::class => ['all' => true],
];
```

## Configuration

The Twig Integration has currently no configuration as twig
is supported out of the box by Symfony and can be configured
via the [Symfony Twig Bundle](https://symfony.com/doc/6.2/reference/configuration/twig.html).
