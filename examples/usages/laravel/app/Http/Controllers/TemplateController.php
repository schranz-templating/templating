<?php

namespace App\Http\Controllers;

use Schranz\Templating\Adapter\Blade\BladeRenderer;
use Schranz\Templating\Adapter\Handlebars\HandlebarsRenderer;
use Schranz\Templating\Adapter\Latte\LatteRenderer;
use Schranz\Templating\Adapter\Mustache\MustacheRenderer;
use Schranz\Templating\Adapter\Plates\PlatesRenderer;
use Schranz\Templating\Adapter\Smarty\SmartyRenderer;
use Schranz\Templating\Adapter\Twig\TwigRenderer;
use Schranz\Templating\TemplateRenderer\TemplateRendererInterface;

class TemplateController extends Controller
{
    public function __construct(
        private TemplateRendererInterface $defaultRenderer,
        private BladeRenderer $bladeRenderer,
        private HandlebarsRenderer $handlebarsRenderer,
        private LatteRenderer $latteRenderer,
        private MustacheRenderer $mustacheRenderer,
        private PlatesRenderer $platesRenderer,
        private SmartyRenderer $smartyRenderer,
        private TwigRenderer $twigRenderer,
    ) {
    }

    public function home(): string
    {
        return
            '<h1>Goto /blade, /handlebars, /latte, /mustache, /plates, /smarty, /twig</h1>' .
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

    public function latteRenderer(): string
    {
        return $this->latteRenderer->render(
            'base.latte',
            [
                'title' => 'Render using: ' . get_class($this->latteRenderer),
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

    public function twigRenderer(): string
    {
        return $this->twigRenderer->render(
            'base.html.twig',
            [
                'title' => 'Render using: ' . get_class($this->twigRenderer),
            ]
        );
    }
}
