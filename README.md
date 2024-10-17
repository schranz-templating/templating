<div align="center">

![PHP Templating Logo with a Rooster on it](https://user-images.githubusercontent.com/1698337/191012382-35f87a5a-24ce-4e6c-8b99-d3ebfdb33339.svg#gh-dark-mode-only)
![PHP Templating Logo with a Rooster on it](https://user-images.githubusercontent.com/1698337/191012387-d8ae68a9-6f14-4dd8-a82b-0c32b2e22d15.svg#gh-light-mode-only)

</div>

<h1 align="center">Schranz Templating</h1>

<div align="center">
   <strong>A template abstraction for PHP template engines.</strong>
</div>

<br/>
<br/>

This project should help to find a way for a general Template Render Interface.
And show an integration of different Template Engines into all common PHP frameworks.

Discussion in the PHP-FIG:

 - [https://github.com/php-fig/fig-standards/pull/1280](https://github.com/php-fig/fig-standards/pull/1280)

Target is that Content Management Systems like [Sulu CMS](https://github.com/sulu/sulu) or even [Typo3](https://github.com/TYPO3/typo3)
but also any library which a project defines how the data is rendered can use the
[`TemplateRendererInterface`](./src/TemplateRenderer/README.md) to render their content to give 100%
freedom about the used Template engine to their projects and easier to implement this kind of libraries
into different PHP frameworks.

## Table of Contents

 - [Motivation](#motivation)
 - [Different to exist abstractions](#different-to-exist-abstractions)
 - [Project Status](#project-status)
 - [Example Applications](#example-applications)
 - [Usage](#usage)
   - [Usage for Library Authors](#usage-for-library-authors)
   - [Usage for Projects](#usage-for-projects)
   - [Usage for Symfony Projects](#usage-for-symfony-projects)
 - [Package List](#package-list)
 - [Analyses](#analysis)
 - [Tooling](#tooling)

## Motivation

Why a TemplateRendererInterface?

Somebody mostly don't see a lot of effort what a `TemplateRendererInterface` can do for the PHP ecosystem.
While most Frameworks has a goto Template Engine, there are also some **Frameworks** not provided with
a specific one and want to support multiple (e.g.: `Mezzio`, `Laminas`, `Yii`, ...). A TemplateRendererInterface
can help it make the integration of every Template engine easier. And even allow to easier upgrade Legacy
projects to newer Frameworks as not the whole templates need to be migrated. But also major frameworks like
`Symfony` and `Laravel` could benefit from supporting a more secure Template engine like [`Latte`](https://latte.nette.org/).

But not only Framework can benefit from a general TemplateRendererInterface, a common interface also
allows **CMS** like [`Sulu CMS`](http://github.com/sulu/sulu), [`Typo3`](https://github.com/TYPO3/typo3), ... 
and more allow to give the Frontend Developer the full freedom how to write their Templates.
While working on [Sulu CMS](https://github.com/sulu/sulu) and working alot with Hexagonal Architecture from DDD.
I was thinking that the PHP-FIG is missing a template abstraction for PHP template engines. So system can
provide controllers which provide data and projects define how that data should be rendered with the template
engine of there choice. Specially as CMS today allow to provide Content via JSON and render a website via React,
Angular, Vue, ... they should also be free to render their website via `Twig`, `Blade`, `Latte`, ... or whatever
Template engine they prefer.

Beside Frameworks and CMSs a general TemplateRendererInterface also helps **Library Authors** to integrate their
library easier into different Frameworks. E.g. a mail library like `symfony/mailer` which provides a
`TemplatedEmail` class could be changed to render the email body via the `TemplateRendererInterface`. And so
could be also be used to render emails with `Blade`, `Latte` and not only `Twig`. Which make it easier to use
this component also in other Frameworks. Also, other functionality like `inky` or `inline_css` functionality
could be provided to every Template Engine via an adapter pattern. Even Controllers can more easily be provided
by Libraries as they would no longer need to be written for all Frameworks template engine.

I think a common `TemplateRendererInterface` would be a great addition to the PHP ecosystem and would make
it easier to use different PHP Libraries, Framework and CMS with the Template Engine somebody prefers and
even make Project upgrade and Framework changes easier.

## Different to exist Abstractions

There are currently existing abstraction for Template engines. Most common inside some frameworks in
the past there did exist the `symfony/templating`. Other abstraction are `mezzio/mezzio-template`,
`laminas/laminas-view`, `template-interop/engine`, and some more.

A common mistake in these abstractions which also are integrations are that they are doing more than they
should. Some like example `Mezzio` is also abstracting configuration. As example `paths`, this is bad in
two ways, it forces that it can only support template engine which supports multiple `paths` or even
require template engine which load there `template` via a Filesystem loader. So this forced configuration
would not allow us to use a Template engine which is using different kind of loading of does not support
multiple directories like `Mustache`, `Latte` (current state), `Handlebars`.

So this abstraction follows the [`Single-Responsibility-Principle`](https://en.wikipedia.org/wiki/Single-responsibility_principle)
which we defined on a very limited scope and that is rendering a given template with the given data.

All template engines are different and there integrations into the different frameworks requires that
the template engines have their own configuration and no config abstraction around it. The project
decides how to configure the template engine and library authors just use the Interface to render a
configured template with the data that library provides.

Also, a common mistake in integrations of Template Engine in Frameworks are not providing the inner
template engine to the outside. I did stumble over integration of `Blade` into `Symfony` Framework
which does not provide Blade itself just a Wrapper service around Blade. This does example not allow
me use a Library which requires Blade directly. So all integrations not only provide the Adapter
for the `TemplateRendererInterface` but also the `Template Engine` service itself. This way libraries
which do not yet support the `TemplateRendererInterface` can easily be integrated into any Framework.
As the provided Integrations provides also the inner Template Engine as a service which could be used
in these edge case.

So the target is a simple Abstract Interface for Rendering a Template with given data. And providing
well documented integrations of Template engines into all kind of Frameworks without limiting there
direct usage and extensibility.

## Project Status

Following table should show the process of integration of different template engines and the abstract
Interface into the different Frameworks. The first part shows the main supported template engines
Twig, Blade and Latte. This is actively maintained template engines. The second part shows some older
template engines which are supported but not actively maintained.  
The third part shows framework specific view integrations which will only be supported in the specific
framework they are used.  
The last part are some exotic template engines which did come up and are also adapters implemented for
them.  
On the right part of the table shows frameworks which are planned to be supported but are not yet
implemented.

| Template Engine | Adapter |     | Symfony | Laravel | Laminas | Mezzio | Spiral |     | Yii | Typo3 | Cake | CodeIgniter |
|-----------------|---------|-----|---------|---------|---------|--------|--------|-----|-----|-------|------|-------------|
| Twig            | ✅       |     | ✅       | ✅       | ✅       | ✅      | ✅      |     |     |       |      |             |
| Blade           | ✅       |     | ✅       | ✅       | ✅       | ✅      | ✅      |     |     |       |      |             |
| Latte           | ✅       |     | ✅       | ✅       | ✅       | ✅      | ✅      |     |     |       |      |             |
|                 |         |     |         |         |         |        |        |     |     |       |      |             |
| Plates          | ✅       |     | ✅       | ✅       | ✅       | ✅      | ✅      |     |     |       |      |             |
| Smarty          | ✅       |     | ✅       | ✅       | ✅       | ✅      | ✅      |     |     |       |      |             |
| Handlebars      | ✅       |     | ✅       | ✅       | ✅       | ✅      | ✅      |     |     |       |      |             |
| Mustache        | ✅       |     | ✅       | ✅       | ✅       | ✅      | ✅      |     |     |       |      |             |
|                 |         |     |         |         |         |        |        |     |     |       |      |             |
| Laminas View    | ✅       |     |         |         | ✅       |        |        |     |     |       |      |             |
| Mezzio Template | ✅       |     |         |         |         | ✅      |        |     |     |       |      |             |
| Spiral View     | ✅       |     |         |         |         |        | ✅      |     |     |       |      |             |
| Yii View        | ✅       |     |         |         |         |        |        |     |     |       |      |             |
| Aura View       | ✅       |     |         |         |         |        |        |     |     |       |      |             |
| Fluid           | ✅       |     |         |         |         |        |        |     |     |       |      |             |
| Cake View       |         |     |         |         |         |        |        |     |     |       |      |             |
| Contao          |         |     |         |         |         |        |        |     |     |       |      |             |
|                 |         |     |         |         |         |        |        |     |     |       |      |             |
| Qiq             | ✅       |     |         |         |         |        |        |     |     |       |      |             |
| PHPTAL          | ✅       |     |         |         |         |        |        |     |     |       |      |             |
| Brainy          | ✅       |     |         |         |         |        |        |     |     |       |      |             |

## Example Applications

There exist for all already implemented frameworks an example application.
Which shows you how to use the Interface or a specific adapter inside the framework.

 - [Symfony](examples/usages/symfony)
 - [Laravel](examples/usages/laravel)
 - [Laminas](examples/usages/laminas)
 - [Mezzio](examples/usages/mezzio)
 - [Spiral](examples/usages/spiral)
 - ...

Go into one of the application directory and run:

```bash
composer install

php -S 127.0.0.1:8000 -t public
```

Open then [http://127.0.0.1:8000/](http://127.0.0.1:8000/) to get a list of available integrations in the example.

- [http://127.0.0.1:8000/twig](http://127.0.0.1:8000/twig)
- [http://127.0.0.1:8000/blade](http://127.0.0.1:8000/blade)
- [http://127.0.0.1:8000/latte](http://127.0.0.1:8000/latte)
- [http://127.0.0.1:8000/plates](http://127.0.0.1:8000/plates)
- [http://127.0.0.1:8000/smarty](http://127.0.0.1:8000/smarty)
- [http://127.0.0.1:8000/handlebars](http://127.0.0.1:8000/handlebars)
- [http://127.0.0.1:8000/mustache](http://127.0.0.1:8000/mustache)
- [http://127.0.0.1:8000/laminas-view](http://127.0.0.1:8000/laminas-view)
- [http://127.0.0.1:8000/mezzio-template](http://127.0.0.1:8000/mezzio-template)
- [http://127.0.0.1:8000/laminas-view](http://127.0.0.1:8000/spiral-view)

## Usage

### Usage for Library Authors

If you create a library, framework or whatever reusable package you should just require the template renderer in the
`require` section of your `composer.json`:

```bash
composer require schranz-templating/template-renderer
```

As library author every service which render a template should use the `TemplateRendererInterface`.
Also every templateName should come from a configuration which can be defined by the user of your
library. That configuration depends on which framework your library is integrated into.

Example Controller:

```php
namespace Your\Package;

use Schranz\Templating\TemplateRendererInterface;

class YourController
{
    public function __construct(
        private TemplateRendererInterface $templateRenderer,
        private string $templateName,
    ) {
    }

    public function yourAction(): YourResponse
    {
        $content = $this->templateRenderer->render($this->templateName, ['your' => 'data']);

        return new YourResponse($content);
    }
}
```

To test your library you can use any of the provided adapters and integrations as `require-dev` dependency.
There should be no requirement to an adapter or integration in the `require` section of your
libraries `composer.json`. This allows the user of your library to choice which one matches best for their
used project and framework.

### Usage for Projects

Projects depending on libraries which where build on top of the `schranz-templating/template-render` abstract
should require the renderer package and an adapter to the template engine they want to use:

```bash
composer require schranz-templating/twig-adapter
composer require schranz-templating/blade-adapter
composer require schranz-templating/latte-adapter

composer require schranz-templating/plates-adapter
composer require schranz-templating/smarty-adapter
composer require schranz-templating/brainy-adapter
composer require schranz-templating/handlebars-adapter
composer require schranz-templating/mustache-adapter

composer require schranz-templating/aura-view-adapter
composer require schranz-templating/fluid-adapter
composer require schranz-templating/laminas-view-adapter
composer require schranz-templating/mezzio-template-adapter
composer require schranz-templating/spiral-view-adapter
composer require schranz-templating/yii-view-adapter

composer require schranz-templating/phptal-adapter
composer require schranz-templating/qiq-adapter
```

**Why Adapters?**

As it would be too much work to create forks of every template engines to implement
the interface for prototyping it is easier to use the [Adapter Design Pattern](https://designpatternsphp.readthedocs.io/en/latest/Structural/Adapter/README.html)
to transfer from the `TemplateRendererInterface` to underlying template engines.

#### Usage for Symfony Projects

To use the integration in the Symfony Framework the following packages are currently provided,
which will register the adapter service and integration of the selected template engine:

```bash
composer require schranz-templating/symfony-twig-integration
composer require schranz-templating/symfony-blade-integration
composer require schranz-templating/symfony-latte-integration

composer require schranz-templating/symfony-plates-integration
composer require schranz-templating/symfony-smarty-integration
composer require schranz-templating/symfony-handlebars-integration
composer require schranz-templating/symfony-mustache-integration
```

#### Usage for Laravel Projects

To use the integration in the Laravel Framework the following packages are currently provided,
which will register the adapter service and integration of the selected template engine:

```bash
composer require schranz-templating/laravel-spiral-view-integration

composer require schranz-templating/laravel-twig-integration
composer require schranz-templating/laravel-blade-integration
composer require schranz-templating/laravel-latte-integration

composer require schranz-templating/laravel-plates-integration
composer require schranz-templating/laravel-smarty-integration
composer require schranz-templating/laravel-handlebars-integration
composer require schranz-templating/laravel-mustache-integration
```

#### Usage for Laminas Projects

To use the integration in the Laminas Framework the following packages are currently provided,
which will register the adapter service and integration of the selected template engine:

```bash
composer require schranz-templating/laminas-laminas-view-integration

composer require schranz-templating/laminas-twig-integration
composer require schranz-templating/laminas-blade-integration
composer require schranz-templating/laminas-latte-integration

composer require schranz-templating/laminas-plates-integration
composer require schranz-templating/laminas-smarty-integration
composer require schranz-templating/laminas-handlebars-integration
composer require schranz-templating/laminas-mustache-integration
```

#### Usage for Mezzio Projects

To use the integration in the Mezzio Framework the following packages are currently provided,
which will register the adapter service and integration of the selected template engine:

```bash
composer require schranz-templating/mezzio-mezzio-template-integration

composer require schranz-templating/mezzio-twig-integration
composer require schranz-templating/mezzio-blade-integration
composer require schranz-templating/mezzio-latte-integration

composer require schranz-templating/mezzio-plates-integration
composer require schranz-templating/mezzio-smarty-integration
composer require schranz-templating/mezzio-handlebars-integration
composer require schranz-templating/mezzio-mustache-integration
```

#### Usage for Spiral Projects

To use the integration in the Spiral Framework the following packages are currently provided,
which will register the adapter service and integration of the selected template engine:

```bash
composer require schranz-templating/spiral-spiral-view-integration

composer require schranz-templating/spiral-twig-integration
composer require schranz-templating/spiral-blade-integration
composer require schranz-templating/spiral-latte-integration

composer require schranz-templating/spiral-plates-integration
composer require schranz-templating/spiral-smarty-integration
composer require schranz-templating/spiral-handlebars-integration
composer require schranz-templating/spiral-mustache-integration
```

## Package List

The current project already provides about more than ~50 packages to integrate different template
engines into different frameworks.

- [x] [TemplateRendererInterface](src/TemplateRenderer/TemplateRendererInterface.php) ([`schranz-templating/template-renderer`](https://github.com/schranz-templating/template-renderer))
- [ ] Adapters
    - [x] [Twig Template Renderer](src/Adapter/Twig/TwigRenderer.php) ([`schranz-templating/twig-adapter`](https://github.com/schranz-templating/twig-adapter))
    - [x] [Blade Template Renderer](src/Adapter/Blade/BladeRenderer.php) ([`schranz-templating/blade-adapter`](https://github.com/schranz-templating/blade-adapter))
    - [x] [Latte Template Renderer](src/Adapter/Latte/LatteRenderer.php) ([`schranz-templating/latte-adapter`](https://github.com/schranz-templating/latte-adapter))
    - [x] [Plates Template Renderer](src/Adapter/Plates/PlatesRenderer.php) ([`schranz-templating/plates-adapter`](https://github.com/schranz-templating/plates-adapter))
    - [x] [Smarty Template Renderer](src/Adapter/Smarty/SmartyRenderer.php) ([`schranz-templating/smarty-adapter`](https://github.com/schranz-templating/smarty-adapter))
    - [x] [Handlebars Renderer](src/Adapter/Handlebars/HandlebarsRenderer.php) ([`schranz-templating/handlebars-adapter`](https://github.com/schranz-templating/handlebars-adapter))
    - [x] [Mustache Renderer](src/Adapter/Mustache/MustacheRenderer.php) ([`schranz-templating/mustache-adapter`](https://github.com/schranz-templating/mustache-adapter))
    - [x] [Laminas View Renderer](src/Adapter/LaminasView/LaminasViewRenderer.php) ([`schranz-templating/laminas-view-adapter`](https://github.com/schranz-templating/laminas-view-adapter))
    - [x] [Mezzio Template Renderer](src/Adapter/Mezzio/MezzioRenderer.php) ([`schranz-templating/mezzio-adapter`](https://github.com/schranz-templating/mezzio-adapter))
    - [x] [YiiView Renderer](src/Adapter/YiiView/YiiViewRenderer.php) ([`schranz-templating/yii-view-adapter`](https://github.com/schranz-templating/yii-view-adapter))
    - [x] [Aura View Renderer](src/Adapter/AuraView/AuraViewRenderer.php) ([`schranz-templating/aura-view-adapter`](https://github.com/schranz-templating/aura-view-adapter))
    - [x] [Spiral View Template Renderer](src/Adapter/SpiralView/SpiralViewRenderer.php) ([`schranz-templating/spiral-view-adapter`](https://github.com/schranz-templating/spiral-view-adapter))
    - [x] [Fluid Renderer](src/Adapter/Fluid/FluidRenderer.php) ([`schranz-templating/fluid-adapter`](https://github.com/schranz-templating/fluid-adapter))
    - [x] [Qiq Template Renderer](src/Adapter/Qiq/QiqRenderer.php) ([`schranz-templating/qiq-adapter`](https://github.com/schranz-templating/qiq-adapter))
    - [x] [PHPTAL Renderer](src/Adapter/PHPTAL/PHPTALRenderer.php) ([`schranz-templating/phptal-adapter`](https://github.com/schranz-templating/phptal-adapter))
    - [x] [Brainy Renderer](src/Adapter/Brainy/BrainyRenderer.php) ([`schranz-templating/brainy-adapter`](https://github.com/schranz-templating/brainy-adapter))
    - [ ] Cake View
    - [ ] Contao
- [ ] Integrations
    - [ ] Symfony
        - [x] [Twig](src/Integration/Symfony/Twig/README.md) ([`schranz-templating/symfony-twig-integration`](https://github.com/schranz-templating/symfony-twig-integration))
        - [x] [Blade](src/Integration/Symfony/Blade/README.md) ([`schranz-templating/symfony-blade-integration`](https://github.com/schranz-templating/symfony-blade-integration))
        - [x] [Latte](src/Integration/Symfony/Latte/README.md) ([`schranz-templating/symfony-latte-integration`](https://github.com/schranz-templating/symfony-latte-integration))
        - [x] [Plates](src/Integration/Symfony/Plates/README.md) ([`schranz-templating/symfony-plates-integration`](https://github.com/schranz-templating/symfony-plates-integration))
        - [x] [Smarty](src/Integration/Symfony/Smarty/README.md) ([`schranz-templating/symfony-smarty-integration`](https://github.com/schranz-templating/symfony-smarty-integration))
        - [x] [Handlebars](src/Integration/Symfony/Handlebars/README.md) ([`schranz-templating/symfony-handlebars-integration`](https://github.com/schranz-templating/symfony-handlebars-integration))
        - [x] [Mustache](src/Integration/Symfony/Mustache/README.md) ([`schranz-templating/symfony-mustache-integration`](https://github.com/schranz-templating/symfony-mustache-integration))
        - [ ] Brainy
        - [ ] PHPTAL
        - [ ] ...
    - [ ] Laravel
        - [x] [Blade](src/Integration/Laravel/Blade/README.md) ([`schranz-templating/laravel-blade-integration`](https://github.com/schranz-templating/laravel-blade-integration))
        - [x] [Twig](src/Integration/Laravel/Twig/README.md) ([`schranz-templating/laravel-twig-integration`](https://github.com/schranz-templating/laravel-twig-integration))
        - [x] [Latte](src/Integration/Laravel/Latte/README.md) ([`schranz-templating/laravel-latte-integration`](https://github.com/schranz-templating/laravel-latte-integration))
        - [x] [Plates](src/Integration/Laravel/Plates/README.md) ([`schranz-templating/laravel-plates-integration`](https://github.com/schranz-templating/laravel-plates-integration))
        - [x] [Smarty](src/Integration/Laravel/Smarty/README.md) ([`schranz-templating/laravel-smarty-integration`](https://github.com/schranz-templating/laravel-smarty-integration))
        - [x] [Handlebars](src/Integration/Laravel/Handlebars/README.md) ([`schranz-templating/laravel-handlebars-integration`](https://github.com/schranz-templating/laravel-handlebars-integration))
        - [x] [Mustache](src/Integration/Laravel/Mustache/README.md) ([`schranz-templating/laravel-mustache-integration`](https://github.com/schranz-templating/laravel-mustache-integration))
        - [ ] Brainy
        - [ ] PHPTAL
        - [ ] ...
    - [ ] Spiral
        - [x] [SpiralView](src/Integration/Spiral/SpiralView/README.md) ([`schranz-templating/spiral-spiral-view-integration`](https://github.com/schranz-templating/spiral-spiral-view-integration))
        - [x] [Twig](src/Integration/Spiral/Twig/README.md) ([`schranz-templating/spiral-twig-integration`](https://github.com/schranz-templating/spiral-twig-integration))
        - [x] [Blade](src/Integration/Spiral/Blade/README.md) ([`schranz-templating/spiral-blade-integration`](https://github.com/schranz-templating/spiral-blade-integration))
        - [x] [Latte](src/Integration/Spiral/Latte/README.md) ([`schranz-templating/spiral-latte-integration`](https://github.com/schranz-templating/spiral-latte-integration))
        - [x] [Plates](src/Integration/Spiral/Plates/README.md) ([`schranz-templating/spiral-plates-integration`](https://github.com/schranz-templating/spiral-plates-integration))
        - [x] [Smarty](src/Integration/Spiral/Smarty/README.md) ([`schranz-templating/spiral-smarty-integration`](https://github.com/schranz-templating/spiral-smarty-integration))
        - [x] [Handlebars](src/Integration/Spiral/Handlebars/README.md) ([`schranz-templating/spiral-handlebars-integration`](https://github.com/schranz-templating/spiral-handlebars-integration))
        - [x] [Mustache](src/Integration/Spiral/Mustache/README.md) ([`schranz-templating/spiral-mustache-integration`](https://github.com/schranz-templating/spiral-mustache-integration))
        - [ ] Brainy
        - [ ] PHPTAL
        - [ ] ...
    - [ ] Laminas
        - [x] [LaminasView](src/Integration/Laminas/LaminasView/README.md) ([`schranz-templating/laminas-laminas-view-integration`](https://github.com/schranz-templating/laminas-laminas-view-integration))
        - [x] [Twig](src/Integration/Laminas/Twig/README.md) ([`schranz-templating/laminas-twig-integration`](https://github.com/schranz-templating/laminas-twig-integration))
        - [x] [Blade](src/Integration/Laminas/Blade/README.md) ([`schranz-templating/laminas-blade-integration`](https://github.com/schranz-templating/laminas-blade-integration))
        - [x] [Latte](src/Integration/Laminas/Latte/README.md) ([`schranz-templating/laminas-latte-integration`](https://github.com/schranz-templating/laminas-latte-integration))
        - [x] [Plates](src/Integration/Laminas/Plates/README.md) ([`schranz-templating/laminas-plates-integration`](https://github.com/schranz-templating/laminas-plates-integration))
        - [x] [Smarty](src/Integration/Laminas/Smarty/README.md) ([`schranz-templating/laminas-smarty-integration`](https://github.com/schranz-templating/laminas-smarty-integration))
        - [x] [Handlebars](src/Integration/Laminas/Handlebars/README.md) ([`schranz-templating/laminas-handlebars-integration`](https://github.com/schranz-templating/laminas-handlebars-integration))
        - [x] [Mustache](src/Integration/Laminas/Mustache/README.md) ([`schranz-templating/laminas-mustache-integration`](https://github.com/schranz-templating/laminas-mustache-integration))
        - [ ] Brainy
        - [ ] PHPTAL
        - [ ] ...
    - [ ] Mezzio
        - [x] [Mezzio](src/Integration/Mezzio/MezzioTemplate/README.md) ([`schranz-templating/mezzio-mezzio-template-integration`](https://github.com/schranz-templating/mezzio-mezzio-template-integration))
        - [x] [Twig](src/Integration/Mezzio/Twig/README.md) ([`schranz-templating/mezzio-twig-integration`](https://github.com/schranz-templating/mezzio-twig-integration))
        - [x] [Latte](src/Integration/Mezzio/Blade/README.md) ([`schranz-templating/mezzio-blade-integration`](https://github.com/schranz-templating/mezzio-blade-integration))
        - [x] [Latte](src/Integration/Mezzio/Latte/README.md) ([`schranz-templating/mezzio-latte-integration`](https://github.com/schranz-templating/mezzio-latte-integration))
        - [x] [Plates](src/Integration/Mezzio/Plates/README.md) ([`schranz-templating/mezzio-plates-integration`](https://github.com/schranz-templating/mezzio-plates-integration))
        - [x] [Smarty](src/Integration/Mezzio/Smarty/README.md) ([`schranz-templating/mezzio-smarty-integration`](https://github.com/schranz-templating/mezzio-smarty-integration))
        - [x] [Handlebars](src/Integration/Mezzio/Handlebars/README.md) ([`schranz-templating/mezzio-handlebars-integration`](https://github.com/schranz-templating/mezzio-handlebars-integration))
        - [x] [Mustache](src/Integration/Mezzio/Mustache/README.md) ([`schranz-templating/mezzio-mustache-integration`](https://github.com/schranz-templating/mezzio-mustache-integration))
        - [ ] Brainy
        - [ ] PHPTAL
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

## Analysis

In the following table we will ist all yet found interesting template engines
and view renderers. What kind of version they currently are and what PHP Version
they are supporting. Also, what kind of features are supported by them.

| Engine          | Version  | PHP Version            | Inheritance | Subviews | Namespaces | Functions | Filters | Exist | Partial | Streaming | String | Raw | Globals |
|-----------------|----------|------------------------|-------------|----------|------------|-----------|---------|-------|---------|-----------|--------|-----|---------|
| Twig            | `3.4.1`  | `>=7.2.5`              | [x]         |          | [x] `@`    | [x]       | [x]     | [x]   | [x]     | [x]       | [x]    | [x] | [x]     |
| Blade           | `9.15.0` | `^8.1`                 | [x]         |          | [x] `::`   | ?         | ?       | ?     | [x]     | ?         | [x]    | ?   | ?       |
| Latte           | `3.0.0`  | `>=8.0 <8.2`           | [x]         |          | ?          |           | [x]     | ?     | ?       | ?         | [x]    | [x] | ?       |
|                 |          |                        |             |          |            |           |         |       |         |           |        |     |         |
| Plates          | `3.4.0`  | `^7.0 ^8.0`            | [x]         |          | [x] `::`   | [x]       |         | ?     |         | ?         | [x]    | ?   | ?       |
| Smarty          | `4.1.1`  | `^7.1 ^8.0`            | [x]         |          | ?          | [x]       | ?       | ?     | ?       | [x]       | [x]    | ?   | ?       |
| Brainy          | `4.0.0`  | `>=7.3`                | [x]         |          | ?          | [x]       | ?       | ?     | ?       | [x]       | [x]    | ?   | ?       |
| Mustache        | `2.14.1` | `>=5.2.4`              |             |          | ?          | ?         | ?       | ?     | ?       | ?         | [x]    | ?   | ?       |
| Handlebars      | `3.0`    | `>=5.4.0`              |             |          | ?          | ?         | ?       | ?     | ?       | ?         | [x]    | ?   | ?       |
|                 |          |                        |             |          |            |           |         |       |         |           |        |     |         |
| Mezzio Template | `3.10.0` | `~7.4.0 ~8.0.0 ~8.1.0` | [x]         |          | [x] `@`    | ?         | ?       | ?     | ?       |           | [x]    | ?   | ?       |
| Spiral View     | `2.13.1` | `>=7.4`                | [x]         |          | ?          | ?         | ?       | ?     | ?       | ?         | ?      | ?   | ?       |
| Laminas View    | `2.20.0` | `^7.4 ~8.0.0 ~8.1.0`   | [x]         | [x]      | ?          | ?         | ?       | ?     | ?       | ?         | [x]    | ?   | ?       |
| Yii View        | `5.0.0 ` | `^7.4 ^8.0`            | [x]         | [x]      | [x] `@`    | ?         | ?       | ?     | ?       | ?         | [x]    | ?   | ?       |
| Fluid           | `2.7.1`  | `>=5.5.0`              | ?           | ?        | ?          | ?         | ?       | ?     | ?       | ?         | [x]    | ?   | ?       |
| Contao          | `4.13.4` | `^7.4 ^8.0`            | ?           | ?        | ?          | ?         | ?       | ?     | ?       | ?         | [x]    | ?   | ?       |
| Aura View       | `2.4.0`  | `>=5.4.0`              | ?           | ?        | ?          | ?         | ?       | ?     | ?       | ?         | [x]    | ?   | ?       |
|                 |          |                        |             |          |            |           |         |       |         |           |        |     |         |
| Qiq             | `1.0.2`  | `^8.0`                 | ?           | ?        | ?          | ?         | ?       | ?     | ?       | ?         | [x]    | ?   | ?       |
| PHPTAL          | `1.7.0`  | `~8.0.0 ~8.1.0 ~8.2.0` | ?           | ?        | ?          | ?         | ?       | ?     | ?       | ?         | [x]    | ?   | ?       |

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
templates `renderBlock` method. In blade via the fragment method on
the view newly added in [lately](https://twitter.com/taylorotwell/status/1590066457458913280).

#### Streaming

Supports to stream the template directly to the output and not have
the need to keep all in a string variable.

E.g. This is achieved in twig via the `display` method.

#### String

Supports to return the template as a string.

E.g. This is achieved in twig via the `render` method, in Smarty/Brainy view the `fetch` method.

#### Raw

Some engines provide auto escaping like twig and latte.
In extensions there need to be a way to disable it.

E.g.: In twig this is handled via `['is_safe' => 'html']`, in Latte via `Latte\Runtime\Html($var)` class.

#### Globals

If the template engine supports to define globals.

E.g.: In twig globals can be defined via extensions.

## Tooling

Tooling around template engines:

 - **Twig**
   - [twig2latte](https://twig2latte.nette.org/)
   - [twigfiddle](https://twigfiddle.com/)
   - [twigstan](https://github.com/twigstan/twigstan)
   - [asm89/twig-lint](https://github.com/asm89/twig-lint)
   - [symfony-twig-lint](https://github.com/symfony/twig-bridge/blob/05e3128cb875e9f21d18c5af2354293cd1dec010/Command/LintCommand.php#L39) `bin/console lint:twig`
   - [reveal/reveal-twig](https://github.com/revealphp/reveal/tree/main/packages/reveal-twig) PHPStan Twig Rules
   - [driveto/phpstan-twig](https://github.com/driveto/phpstan-twig)
   - [matthiasnoback/phpstan-twig-analysis](https://github.com/matthiasnoback/phpstan-twig-analysis)
   - [friendsoftwig/twigcs](https://github.com/friendsoftwig/twigcs)
   - [VincentLanglet/Twig-CS-Fixer](https://github.com/VincentLanglet/Twig-CS-Fixer)
   - [k10r/twig-cs-fixer](https://github.com/kellerkinderDE/twig-cs-fixer)

 - **Latte**
   - [twig2latte](https://twig2latte.nette.org/)
   - [lattefiddle](https://fiddle.nette.org/latte/)
   - [reveal/reveal-latte](https://github.com/revealphp/reveal/tree/main/packages/reveal-latte) PHPStan Latte Rules

 - **Blade**
   - [TomasVotruba/bladestan](https://github.com/TomasVotruba/bladestan)
   - [bdelespierre/laravel-blade-linter](https://github.com/bdelespierre/laravel-blade-linter)
   - [magentron/laravel-blade-lint](https://github.com/Magentron/laravel-blade-lint)
   - [canvural/phpstan-blade-rule](https://github.com/canvural/phpstan-blade-rule)
   - [thibaud-dauce/phpstan-blade](https://github.com/ThibaudDauce/phpstan-blade)
   - [beyondcode/laravel-prose-linter](https://github.com/beyondcode/laravel-prose-linter)
   - [stillat/blade-parser](https://github.com/stillat/blade-parser)
   - [tighten/tlint](https://github.com/tighten/tlint)
   - [prettier-plugin-blade](https://www.npmjs.com/package/prettier-plugin-blade)

Please let me know about more tools around template engines.
