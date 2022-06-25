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

## TODO

 - [x] [TemplateRendererInterface](src/TemplateRenderer/TemplateRendererInterface.php) (`schranz-templating/template-renderer`)
 - [ ] Bridges
   - [x] [Twig Template Renderer](src/Bridge/Twig/TwigRenderer.php) (`schranz-templating/twig-bridge`)
   - [x] [Smarty Template Renderer](src/Bridge/Smarty/SmartyRenderer.php) (`schranz-templating/smarty-bridge`)
   - [x] [Latte Template Renderer](src/Bridge/Latte/LatteRenderer.php) (`schranz-templating/latte-bridge`)
   - [x] [Blade Template Renderer](src/Bridge/Blade/BladeRenderer.php) (`schranz-templating/blade-bridge`)
   - [x] [Mezzio Template Renderer](src/Bridge/Mezzio/MezzioRenderer.php) (`schranz-templating/mezzio-bridge`)
   - [x] [Plates Template Renderer](src/Bridge/Plates/PlatesRenderer.php) (`schranz-templating/plates-bridge`)
   - [x] [Mustache Renderer](src/Bridge/Mustache/MustacheRenderer.php) (`schranz-templating/mustache-bridge`)
   - [x] [Handlebars Renderer](src/Bridge/Handlebars/HandlebarsRenderer.php) (`schranz-templating/handlebars-bridge`)
   - [x] [Laminas View Renderer](src/Bridge/LaminasView/LaminasViewRenderer.php) (`schranz-templating/laminas-view-bridge`)
   - [x] [YiiView Renderer](src/Bridge/YiiView/YiiViewRenderer.php) (`schranz-templating/yii-view-bridge`)
   - [x] [Spiral View Template Renderer](src/Bridge/SpiralView/SpiralViewRenderer.php) (`schranz-templating/spiral-view-bridge`)
     - [ ] Stempler?
   - [ ] Fluid (Typo3)
   - [ ] Cake View
   - [ ] Contao
 - [ ] Integrations
   - [ ] Symfony
   - [ ] Laravel
   - [ ] Spiral
   - [ ] Laminas
   - [ ] Mezzio
   - [ ] Yii
   - [ ] Cake
   - [ ] CodeIgniter
   - [ ] Typo3
 - [ ] Subtree Split
 - [ ] Register Packages

## Usage for Library Authors

If you create a library, framework or whatever you should just require the template renderer in the
require section of your composer.json:

```bash
composer require schranz-templating/template-renderer
```

## Usage for Projects

Projects depending on libraries which where build on top of the schranz-templating/template-render abstract
should require the renderer package and a bridge to the template engine they want to use:

```bash
composer require schranz-templating/template-renderer
# one of:
composer require schranz-templating/blade-bridge
composer require schranz-templating/handlebars-bridge
composer require schranz-templating/laminas-view-bridge
composer require schranz-templating/latte-bridge
composer require schranz-templating/mezzio-bridge
composer require schranz-templating/mustache-bridge
composer require schranz-templating/plates-bridge
composer require schranz-templating/smarty-bridge
composer require schranz-templating/spiral-view-bridge
composer require schranz-templating/twig-bridge
composer require schranz-templating/yii-view-bridge
```

## Analysis

In the following table we will ist all yet found interesting template engines
and view renderers. What kind of version they currently are and what PHP Version
they are supporting. Also what kind of features are supported by them.

| Engine       | Version  | PHP Version            | Inheritance | Subviews | Namespaces | Functions | Filters | Exist | Partial | Streaming | String | Implemented |
|--------------|----------|------------------------|-------------|----------|------------|-----------|---------|-------|---------|-----------|--------|-------------|
| Twig         | `3.4.1`  | `>=7.2.5`              | [x]         |          | [x] `@`    | [x]       | [x]     | [x]   | [x]     | [x]       | [x]    | [x]         |
| Smarty       | `4.1.1`  | `^7.1 ^8.0`            | [x]         |          | ?          | [x]       | ?       | ?     | ?       | [x]       |        | [x]         |
| Latte        | `3.0.0`  | `>=8.0 <8.2`           | [x]         |          | ?          |           | [x]     | ?     | ?       | ?         | [x]    | [x]         |
| Blade        | `9.15.0` | `^8.1`                 | [x]         |          | [x] `::`   | ?         | ?       | ?     | ?       | ?         | [x]    | [x]         |
| Spiral View  | `2.13.1` | `>=7.4`                | [x]         |          | ?          | ?         | ?       | ?     | ?       | ?         | ?      | [x]         |
| Stempler     | `2.13.1` | `>=7.4`                | [x]         |          | ?          | ?         | ?       | ?     | ?       | ?         | ?      | [ ]         |
| Mezzio       | `3.10.0` | `~7.4.0 ~8.0.0 ~8.1.0` | [x]         |          | [x] `@`    | ?         | ?       | ?     | ?       |           | [x]    | [x]         |
| Plates       | `3.4.0`  | `^7.0 ^8.0`            | [x]         |          |            |           |         | ?     |         | ?         | [x]    | [x]         |
| Laminas View | `2.20.0` | `^7.4 ~8.0.0 ~8.1.0`   | [x]         | [x]      | ?          | ?         | ?       | ?     | ?       | ?         | [x]    | [x]         |
| Yii View     | `5.0.0 ` | `^7.4 ^8.0`            | [x]         | [x]      | [x] `@`    | ?         | ?       | ?     | ?       | ?         | [x]    | [x]         |
| Fluid        | `2.7.1`  | `>=5.5.0`              | ?           | ?        | ?          | ?         | ?       | ?     | ?       | ?         | [x]    | [ ]         |
| Contao       | `4.13.4` | `^7.4 ^8.0`            | ?           | ?        | ?          | ?         | ?       | ?     | ?       | ?         | [x]    | [ ]         |
| Mustache     | `2.14.1` | `>=5.2.4`              | ?           | ?        | ?          | ?         | ?       | ?     | ?       | ?         | [x]    | [x]         |
| Handlebars   | `2.3.0`  | `>=5.4.0`              | ?           | ?        | ?          | ?         | ?       | ?     | ?       | ?         | [x]    | [x]         |

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
the need to keep al in a string variable.

E.g. This is achieved in twig via the `display` method.

#### String

Supports to stream the template directly to the output and not have
the need to keep al in a string variable.

E.g. This is achieved in twig via the `display` method.

#### Implemented

A bridge was already implemented for this engine and so a common interface
for this type of engine would be possible.
