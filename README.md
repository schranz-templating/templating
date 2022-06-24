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
   - [x] [Spiral View Template Renderer](src/Bridge/SpiralView/SpiralViewRenderer.php) (`schranz-templating/spiral-view-bridge`)
     - [ ] Stempler?
   - [ ] Mustache
   - [ ] Yii View
   - [ ] Fluid (Typo3)
 - [ ] Integrations
   - [ ] Symfony
   - [ ] Laravel
   - [ ] Spiral
   - [ ] Laminas
   - [ ] Mezzio
   - [ ] Yii
   - [ ] Cake
   - [ ] CodeIgniter
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
composer require schranz-templating/twig-bridge
composer require schranz-templating/smarty-bridge
composer require schranz-templating/latte-bridge
composer require schranz-templating/blade-bridge
composer require schranz-templating/mezzio-bridge
composer require schranz-templating/plates-bridge
composer require schranz-templating/spiral-view-bridge
```
