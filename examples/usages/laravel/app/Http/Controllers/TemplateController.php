<?php

namespace App\Http\Controllers;

use Schranz\Templating\Bridge\Blade\BladeRenderer;
use Schranz\Templating\Bridge\Handlebars\HandlebarsRenderer;
use Schranz\Templating\Bridge\Mustache\MustacheRenderer;
use Schranz\Templating\Bridge\Plates\PlatesRenderer;
use Schranz\Templating\Bridge\Smarty\SmartyRenderer;
use Schranz\Templating\TemplateRenderer\TemplateRendererInterface;

class TemplateController extends Controller
{
    public function __construct(
        private TemplateRendererInterface $defaultRenderer,
        private BladeRenderer $bladeRenderer,
        private HandlebarsRenderer $handlebarsRenderer,
        private MustacheRenderer $mustacheRenderer,
        private PlatesRenderer $platesRenderer,
        private SmartyRenderer $smartyRenderer,
    ) {
    }

    public function home(): string
    {
        return
            '<h1>Goto /blade, /handlebars, /mustache, /plates, /smarty, more todo ...</h1>' .
            '<p>Default Renderer is: ' . get_class($this->defaultRenderer) . '</p>'
        ;
    }

    public function bladeRenderer(): string
    {
        return $this->bladeRenderer->render(
            'base',
            [
                'title' => 'Render using: ' . get_class($this->bladeRenderer),
            ]
        );
    }

    public function handlebarsRenderer(): string
    {
        return $this->handlebarsRenderer->render(
            'base',
            [
                'title' => 'Render using: ' . get_class($this->handlebarsRenderer),
            ]
        );
    }

    public function mustacheRenderer(): string
    {
        return $this->mustacheRenderer->render(
            'base',
            [
                'title' => 'Render using: ' . get_class($this->mustacheRenderer),
            ]
        );
    }

    public function platesRenderer(): string
    {
        return $this->platesRenderer->render(
            'base.plates',
            [
                'title' => 'Render using: ' . get_class($this->platesRenderer),
            ]
        );
    }

    public function smartyRenderer(): string
    {
        return $this->smartyRenderer->render(
            'base.tpl',
            [
                'title' => 'Render using: ' . get_class($this->smartyRenderer),
            ]
        );
    }
}
