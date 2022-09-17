<div align="center">
 
![PHP Templating Logo with a Rooster on it](https://user-images.githubusercontent.com/1698337/175612156-b475d5bc-6caa-413f-b741-ff14ce861d5d.png)

</div>

<h1 align="center">Schranz Templating</h1>

<div align="center">
   <strong>A template abstraction prototype for PHP template engines.</strong>
</div>

<br/>
<br/>

This project should help to find a way for a general Template Render Interface.

Discussion in the PHP-FIG:

 - [https://github.com/php-fig/fig-standards/pull/1280](https://github.com/php-fig/fig-standards/pull/1280)

## Table of Contents

 - [TODO](#todo)
 - [Usage](#usage)
   - [Usage for Library Authors](#usage-for-library-authors)
   - [Usage for Projects](#usage-for-projects)
   - [Usage for Symfony Projects](#usage-for-symfony-projects)
 - [Analyses](#analysis)
 - [Tooling](#tooling)

## TODO

 - [x] [TemplateRendererInterface](src/TemplateRenderer/TemplateRendererInterface.php) ([`schranz-templating/template-renderer`](https://github.com/schranz-templating/template-renderer))
 - [ ] Adapters
   - [x] [Twig Template Renderer](src/Adapter/Twig/TwigRenderer.php) ([`schranz-templating/twig-adapter`](https://github.com/schranz-templating/twig-adapter))
   - [x] [Smarty Template Renderer](src/Adapter/Smarty/SmartyRenderer.php) ([`schranz-templating/smarty-adapter`](https://github.com/schranz-templating/smarty-adapter))
   - [x] [Latte Template Renderer](src/Adapter/Latte/LatteRenderer.php) ([`schranz-templating/latte-adapter`](https://github.com/schranz-templating/latte-adapter))
   - [x] [Blade Template Renderer](src/Adapter/Blade/BladeRenderer.php) ([`schranz-templating/blade-adapter`](https://github.com/schranz-templating/blade-adapter))
   - [x] [Mezzio Template Renderer](src/Adapter/Mezzio/MezzioRenderer.php) ([`schranz-templating/mezzio-adapter`](https://github.com/schranz-templating/mezzio-adapter))
   - [x] [Plates Template Renderer](src/Adapter/Plates/PlatesRenderer.php) ([`schranz-templating/plates-adapter`](https://github.com/schranz-templating/plates-adapter))
   - [x] [Mustache Renderer](src/Adapter/Mustache/MustacheRenderer.php) ([`schranz-templating/mustache-adapter`](https://github.com/schranz-templating/mustache-adapter))
   - [x] [Handlebars Renderer](src/Adapter/Handlebars/HandlebarsRenderer.php) ([`schranz-templating/handlebars-adapter`](https://github.com/schranz-templating/handlebars-adapter))
   - [x] [Laminas View Renderer](src/Adapter/LaminasView/LaminasViewRenderer.php) ([`schranz-templating/laminas-view-adapter`](https://github.com/schranz-templating/laminas-view-adapter))
   - [x] [YiiView Renderer](src/Adapter/YiiView/YiiViewRenderer.php) ([`schranz-templating/yii-view-adapter`](https://github.com/schranz-templating/yii-view-adapter))
   - [x] [Aura View Renderer](src/Adapter/AuraView/AuraViewRenderer.php) ([`schranz-templating/aura-view-adapter`](https://github.com/schranz-templating/aura-view-adapter))
   - [x] [Qiq Template Renderer](src/Adapter/Qiq/QiqRenderer.php) ([`schranz-templating/qiq-adapter`](https://github.com/schranz-templating/qiq-adapter))
   - [x] [Spiral View Template Renderer](src/Adapter/SpiralView/SpiralViewRenderer.php) ([`schranz-templating/spiral-view-adapter`](https://github.com/schranz-templating/spiral-view-adapter))
   - [x] [Fluid Renderer](src/Adapter/Fluid/FluidRenderer.php) ([`schranz-templating/fluid-adapter`](https://github.com/schranz-templating/fluid-adapter))
   - [ ] Cake View
   - [ ] Contao
 - [ ] Integrations
   - [ ] Symfony
     - [x] [Twig](src/Integration/Symfony/Twig/README.md) ([`schranz-templating/symfony-twig-integration`](https://github.com/schranz-templating/symfony-twig-integration))
     - [x] [Blade](src/Integration/Symfony/Blade/README.md) ([`schranz-templating/symfony-blade-integration`](https://github.com/schranz-templating/symfony-blade-integration))
     - [x] [Latte](src/Integration/Symfony/Latte/README.md) ([`schranz-templating/symfony-latte-integration`](https://github.com/schranz-templating/symfony-latte-integration))
     - [x] [Mustache](src/Integration/Symfony/Mustache/README.md) ([`schranz-templating/symfony-mustache-integration`](https://github.com/schranz-templating/symfony-mustache-integration))
     - [x] [Plates](src/Integration/Symfony/Plates/README.md) ([`schranz-templating/symfony-plates-integration`](https://github.com/schranz-templating/symfony-plates-integration))
     - [x] [Handlebars](src/Integration/Symfony/Handlebars/README.md) ([`schranz-templating/symfony-handlebars-integration`](https://github.com/schranz-templating/symfony-handlebars-integration))
     - [x] [Smarty](src/Integration/Symfony/Smarty/README.md) ([`schranz-templating/symfony-smarty-integration`](https://github.com/schranz-templating/symfony-smarty-integration))
     - [ ] ...
   - [ ] Laravel
     - [x] [Blade](src/Integration/Laravel/Blade/README.md) ([`schranz-templating/laravel-blade-integration`](https://github.com/schranz-templating/laravel-blade-integration))
     - [x] [Handlebars](src/Integration/Laravel/Handlebars/README.md) ([`schranz-templating/laravel-handlebars-integration`](https://github.com/schranz-templating/laravel-handlebars-integration))
     - [x] [Latte](src/Integration/Laravel/Latte/README.md) ([`schranz-templating/laravel-latte-integration`](https://github.com/schranz-templating/laravel-latte-integration))
     - [x] [Mustache](src/Integration/Laravel/Mustache/README.md) ([`schranz-templating/laravel-mustache-integration`](https://github.com/schranz-templating/laravel-mustache-integration))
     - [x] [Plates](src/Integration/Laravel/Plates/README.md) ([`schranz-templating/laravel-plates-integration`](https://github.com/schranz-templating/laravel-plates-integration))
     - [x] [Smarty](src/Integration/Laravel/Smarty/README.md) ([`schranz-templating/laravel-smarty-integration`](https://github.com/schranz-templating/laravel-smarty-integration))
     - [x] [Twig](src/Integration/Laravel/Twig/README.md) ([`schranz-templating/laravel-twig-integration`](https://github.com/schranz-templating/laravel-twig-integration))
     - [ ] ...
   - [ ] Spiral
      - [ ] SpiralView
      - [ ] ...
   - [ ] Laminas
      - [x] [LaminasView](src/Integration/Laminas/LaminasView/README.md) ([`schranz-templating/laminas-laminas-view-integration`](https://github.com/schranz-templating/laminas-laminas-view-integration))
      - [x] [Blade](src/Integration/Laminas/Blade/README.md) ([`schranz-templating/laminas-blade-integration`](https://github.com/schranz-templating/laminas-blade-integration))
      - [x] [Handlebars](src/Integration/Laminas/Handlebars/README.md) ([`schranz-templating/laminas-handlebars-integration`](https://github.com/schranz-templating/laminas-handlebars-integration))
      - [x] [Latte](src/Integration/Laminas/Latte/README.md) ([`schranz-templating/laminas-latte-integration`](https://github.com/schranz-templating/laminas-latte-integration))
      - [x] [Mustache](src/Integration/Laminas/Mustache/README.md) ([`schranz-templating/laminas-mustache-integration`](https://github.com/schranz-templating/laminas-mustache-integration))
      - [x] [Plates](src/Integration/Laminas/Plates/README.md) ([`schranz-templating/laminas-plates-integration`](https://github.com/schranz-templating/laminas-plates-integration))
      - [x] [Smarty](src/Integration/Laminas/Smarty/README.md) ([`schranz-templating/laminas-smarty-integration`](https://github.com/schranz-templating/laminas-smarty-integration))
      - [x] [Twig](src/Integration/Laminas/Twig/README.md) ([`schranz-templating/laminas-twig-integration`](https://github.com/schranz-templating/laminas-twig-integration))
      - [ ] ...
   - [ ] Mezzio
      - [ ] Mezzio
      - [ ] ...
   - [ ] Yii
      - [ ] YiiView
      - [ ] ...
   - [ ] Typo3
      - [ ] Fluid
      - [ ] ...
   - [ ] Cake
      - [ ] ...
   - [ ] CodeIgniter
      - [ ] ...
 - [x] Subtree Split
 - [x] Register Packages

## Usage

### Usage for Library Authors

If you create a library, framework or whatever you should just require the template renderer in the
`require` section of your `composer.json`:

```bash
composer require schranz-templating/template-renderer
```

### Usage for Projects

Projects depending on libraries which where build on top of the `schranz-templating/template-render` abstract
should require the renderer package and an adapter to the template engine they want to use:

```bash
composer require schranz-templating/aura-view-adapter
composer require schranz-templating/blade-adapter
composer require schranz-templating/fluid-adapter
composer require schranz-templating/handlebars-adapter
composer require schranz-templating/laminas-view-adapter
composer require schranz-templating/latte-adapter
composer require schranz-templating/mezzio-adapter
composer require schranz-templating/mustache-adapter
composer require schranz-templating/plates-adapter
composer require schranz-templating/qiq-adapter
composer require schranz-templating/smarty-adapter
composer require schranz-templating/spiral-view-adapter
composer require schranz-templating/twig-adapter
composer require schranz-templating/yii-view-adapter
```

**Why Adapters?**

As it would be too much work to create forks of every template engines to implement
the interface for prototyping it is easier to use the [Adapter Design Pattern](https://designpatternsphp.readthedocs.io/en/latest/Structural/Adapter/README.html)
to transfer from the `TemplateRendererInterface` to underlying template engines.

#### Usage for Symfony Projects

To use the integration in the Symfony the following packages are currently provided,
which will register the adapter service and integration of the selected template engine:

```bash
composer require schranz-templating/symfony-blade-integration
composer require schranz-templating/symfony-handlebars-integration
composer require schranz-templating/symfony-latte-integration
composer require schranz-templating/symfony-mustache-integration
composer require schranz-templating/symfony-plates-integration
composer require schranz-templating/symfony-smarty-integration
composer require schranz-templating/symfony-twig-integration
```

#### Usage for Laravel Projects

To use the integration in the Laravel the following packages are currently provided,
which will register the adapter service and integration of the selected template engine:

```bash
composer require schranz-templating/laravel-blade-integration
composer require schranz-templating/laravel-handlebars-integration
composer require schranz-templating/laravel-latte-integration
composer require schranz-templating/laravel-mustache-integration
composer require schranz-templating/laravel-plates-integration
composer require schranz-templating/laravel-smarty-integration
composer require schranz-templating/laravel-twig-integration
```

#### Usage for Laminas Projects

To use the integration in the Laravel the following packages are currently provided,
which will register the adapter service and integration of the selected template engine:

```bash
composer require schranz-templating/laminas-laminas-view-integration
composer require schranz-templating/laminas-blade-integration
composer require schranz-templating/laminas-handlebars-integration
composer require schranz-templating/laminas-latte-integration
composer require schranz-templating/laminas-mustache-integration
composer require schranz-templating/laminas-plates-integration
composer require schranz-templating/laminas-smarty-integration
composer require schranz-templating/laminas-twig-integration
```

## Analysis

In the following table we will ist all yet found interesting template engines
and view renderers. What kind of version they currently are and what PHP Version
they are supporting. Also, what kind of features are supported by them.

| Engine       | Version  | PHP Version            | Inheritance | Subviews | Namespaces | Functions | Filters | Exist | Partial | Streaming | String | Raw | Globals | Implemented |
|--------------|----------|------------------------|-------------|----------|------------|-----------|---------|-------|---------|-----------|--------|-----|---------|-------------|
| Twig         | `3.4.1`  | `>=7.2.5`              | [x]         |          | [x] `@`    | [x]       | [x]     | [x]   | [x]     | [x]       | [x]    | [x] | [x]     | [x]         |
| Smarty       | `4.1.1`  | `^7.1 ^8.0`            | [x]         |          | ?          | [x]       | ?       | ?     | ?       | [x]       |        | ?   | ?       | [x]         |
| Latte        | `3.0.0`  | `>=8.0 <8.2`           | [x]         |          | ?          |           | [x]     | ?     | ?       | ?         | [x]    | [x] | ?       | [x]         |
| Blade        | `9.15.0` | `^8.1`                 | [x]         |          | [x] `::`   | ?         | ?       | ?     | ?       | ?         | [x]    | ?   | ?       | [x]         |
| Spiral View  | `2.13.1` | `>=7.4`                | [x]         |          | ?          | ?         | ?       | ?     | ?       | ?         | ?      | ?   | ?       | [x]         |
| Mezzio       | `3.10.0` | `~7.4.0 ~8.0.0 ~8.1.0` | [x]         |          | [x] `@`    | ?         | ?       | ?     | ?       |           | [x]    | ?   | ?       | [x]         |
| Plates       | `3.4.0`  | `^7.0 ^8.0`            | [x]         |          | [x] `::`   | [x]       |         | ?     |         | ?         | [x]    | ?   | ?       | [x]         |
| Laminas View | `2.20.0` | `^7.4 ~8.0.0 ~8.1.0`   | [x]         | [x]      | ?          | ?         | ?       | ?     | ?       | ?         | [x]    | ?   | ?       | [x]         |
| Yii View     | `5.0.0 ` | `^7.4 ^8.0`            | [x]         | [x]      | [x] `@`    | ?         | ?       | ?     | ?       | ?         | [x]    | ?   | ?       | [x]         |
| Fluid        | `2.7.1`  | `>=5.5.0`              | ?           | ?        | ?          | ?         | ?       | ?     | ?       | ?         | [x]    | ?   | ?       | [x]         |
| Contao       | `4.13.4` | `^7.4 ^8.0`            | ?           | ?        | ?          | ?         | ?       | ?     | ?       | ?         | [x]    | ?   | ?       | [ ]         |
| Mustache     | `2.14.1` | `>=5.2.4`              |             |          | ?          | ?         | ?       | ?     | ?       | ?         | [x]    | ?   | ?       | [x]         |
| Handlebars   | `2.3.0`  | `>=5.4.0`              |             |          | ?          | ?         | ?       | ?     | ?       | ?         | [x]    | ?   | ?       | [x]         |
| Qiq          | `1.0.2`  | `^8.0`                 | ?           | ?        | ?          | ?         | ?       | ?     | ?       | ?         | [x]    | ?   | ?       | [x]         |
| Aura View    | `2.4.0`  | `>=5.4.0`              | ?           | ?        | ?          | ?         | ?       | ?     | ?       | ?         | [x]    | ?   | ?       | [x]         |

### Feature Support

In the table above it is listed which features are supported by different
template engines. Beneath a more detail description about the requirement
to fulfill it is given.

#### Inheritance

With support for template inheritance it means that a rendered template
can inherit from a parent template and overwrite parts in the template
language itself. This feature is not fulfilled for template engines which
only allow to give subviews into a parent view or other way around.

E.g.: This is achieved in twig via extends and blocks. In blade via
extends and sections keywords. In latte via layout and blocks keywords.
Laminas view via the layout helper.

#### Subviews

This is the opposite way of creating layout and base template. Why it is
possible via all engines to call several render calls and put template 
together. This is only fulfilled for template engines explicit working
with a view, layout system and support given view with subviews them
in the renderer call.

E.g.: In laminas view this is possible via the setLayout before calling
the rendering of the template.

This is not fulfilled by twig, blade or latte as they support layout
and inheritance only on template level not on render caller level.

#### Namespaces

The template engine allow to render specific template from different
directories via namepaces. Also how a namespace is reference should
be listed.

E.g. This is achieved in twig via the `@Namespace/` and in Blade and Latte via `namespace::` template names.

#### Functions

The template engine allows to define custom functions which can be
called via the that name in the template.

E.g.: This is achieved in twig via twig extension and twig functions.

#### Exist

The template engine allows to check if a template with a specific
name does exist or not.

E.g.: This is achieved in twig via the getLoader()->exist method.

#### Filter

The template engine allows to define custom filters which can be
called via the that name on a specific variable in the template.

E.g.: This is achieved in twig via twig extension, twig filters and the filter `|` operator.

#### Partial

The template engine allows to render only a subpart of a template.

E.g. This is achieved in twig via loading the template and use the
templates `renderBlock` method.

#### Streaming

Supports to stream the template directly to the output and not have
the need to keep all in a string variable.

E.g. This is achieved in twig via the `display` method.

#### String

Supports to return the template as a string.

E.g. This is achieved in twig via the `render` method.

#### Raw

Some engines provide auto escaping like twig and latte.
In extensions there need to be a way to disable it.

E.g.: In twig this is handled via `['is_safe' => 'html']`, in Latte via `Latte\Runtime\Html($var)` class.

#### Globals

If the template engine supports to define globals.

E.g.: In twig globals can be defined via extensions.

#### Implemented

A adapter was already implemented for this engine and so a common interface
for this type of engine would be possible.

## Tooling

Tooling around template engines:

 - **Twig**
   - [twig2latte](https://twig2latte.nette.org/)
   - [twigfiddle](https://twigfiddle.com/);
   - [asm89/twig-lint](https://github.com/asm89/twig-lint)
   - [symfony-twig-lint](https://github.com/symfony/twig-bridge/blob/05e3128cb875e9f21d18c5af2354293cd1dec010/Command/LintCommand.php#L39)
   - [reveal/reveal-twig](https://github.com/revealphp/reveal/tree/main/packages/reveal-twig) PHPStan Twig Rules
   - [matthiasnoback/phpstan-twig-analysis](https://github.com/matthiasnoback/phpstan-twig-analysis)

 - **Latte**
   - [twig2latte](https://twig2latte.nette.org/)
   - [lattefiddle](https://fiddle.nette.org/latte/)
   - [reveal/reveal-latte](https://github.com/revealphp/reveal/tree/main/packages/reveal-latte) PHPStan Latte Rules

 - **Blade**
     - [bdelespierre/laravel-blade-linter](https://github.com/bdelespierre/laravel-blade-linter)
     - [magentron/laravel-blade-lint](https://github.com/Magentron/laravel-blade-lint)

Please let me know about more tools around template engines.
