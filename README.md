# Schranz Templating

A template abstraction prototype for php template engines.

This project should help to find a way for a general Template Render Interface.

Discussion in the PHP-FIG:

 - [https://github.com/php-fig/fig-standards/pull/1280](https://github.com/php-fig/fig-standards/pull/1280)

## TODO

 - [x] [TemplateRendererInterface](src/TemplateRenderer/TemplateRendererInterface.php) (`schranz-templating/template-renderer`)
 - [x] [Twig Template Renderer](src/Bridge/Twig/TwigRenderer.php) (`schranz-templating/twig-bridge`)
 - [x] [Smarty Template Renderer](src/Bridge/Smarty/SmartyRenderer.php) (`schranz-templating/smarty-bridge`)
 - [x] [Latte Template Renderer](src/Bridge/Latte/LatteRenderer.php) (`schranz-templating/latte-bridge`)
 - [x] [Blade Template Renderer](src/Bridge/Blade/BladeRenderer.php) (`schranz-templating/blade-bridge`)
 - [x] [Mezzio Template Renderer](src/Bridge/Mezzio/MezzioRenderer.php) (`schranz-templating/mezzio-bridge`)
 - [x] [Plates Template Renderer](src/Bridge/Plates/PlatesRenderer.php) (`schranz-templating/plates-bridge`)
 - [ ] Mustache
 - [ ] Yii View
 - [ ] Fluid (Typo3)
 - [ ] Subtree Split
 - [ ] Register Packages
