<?php

declare(strict_types=1);

namespace App\Api\Web\Controller;

use Schranz\Templating\Adapter\Blade\BladeRenderer;
use Schranz\Templating\Adapter\Handlebars\HandlebarsRenderer;
use Schranz\Templating\Adapter\Latte\LatteRenderer;
use Schranz\Templating\Adapter\Mustache\MustacheRenderer;
use Schranz\Templating\Adapter\Plates\PlatesRenderer;
use Schranz\Templating\Adapter\Smarty\SmartyRenderer;
use Schranz\Templating\Adapter\SpiralView\SpiralViewRenderer;
use Schranz\Templating\Adapter\Twig\TwigRenderer;
use Schranz\Templating\TemplateRenderer\TemplateRendererInterface;
use Spiral\Router\Annotation\Route;

class TemplateController
{
    #[Route(route: '/', name: 'index', methods: 'GET')]
    public function index(?TemplateRendererInterface $defaultRenderer = null): string
    {
        return
            '<h1>Goto /twig, /blade, /latte, /smarty, /handlebars, /mustache, /plates</h1>' .
            '<p>Default Renderer is: ' . get_debug_type($defaultRenderer) . '</p>'
        ;
    }

    #[Route(route: '/twig', name: 'twig', methods: 'GET')]
    public function twigRenderer(TwigRenderer $twigRenderer): string
    {
        return $twigRenderer->render(
            'base.twig',
            [
                'title' => 'Render using: ' . get_class($twigRenderer),
            ]
        );
    }

    #[Route(route: '/smarty', name: 'smarty', methods: 'GET')]
    public function smartyRenderer(SmartyRenderer $smartyRenderer): string
    {
        return $smartyRenderer->render(
            'base.tpl',
            [
                'title' => 'Render using: ' . get_class($smartyRenderer),
            ]
        );
    }

    #[Route(route: '/handlebars', name: 'handlebars', methods: 'GET')]
    public function handlebarsRenderer(HandlebarsRenderer $handlebarsRenderer): string
    {
        return $handlebarsRenderer->render(
            'base.handlebars',
            [
                'title' => 'Render using: ' . get_class($handlebarsRenderer),
            ]
        );
    }

    #[Route(route: '/mustache', name: 'mustache', methods: 'GET')]
    public function mustacheRenderer(MustacheRenderer $mustacheRenderer): string
    {
        return $mustacheRenderer->render(
            'base.mustache',
            [
                'title' => 'Render using: ' . get_class($mustacheRenderer),
            ]
        );
    }

    #[Route(route: '/plates', name: 'plates', methods: 'GET')]
    public function platesRenderer(PlatesRenderer $platesRenderer): string
    {
        return $platesRenderer->render(
            'base.plates',
            [
                'title' => 'Render using: ' . get_class($platesRenderer),
            ]
        );
    }

    #[Route(route: '/latte', name: 'latte', methods: 'GET')]
    public function latteRenderer(LatteRenderer $latteRenderer): string
    {
        return $latteRenderer->render(
            'base.latte',
            [
                'title' => 'Render using: ' . get_class($latteRenderer),
            ]
        );
    }

    #[Route(route: '/blade', name: 'blade', methods: 'GET')]
    public function bladeRenderer(BladeRenderer $bladeRenderer): string
    {
        return $bladeRenderer->render(
            'base',
            [
                'title' => 'Render using: ' . get_class($bladeRenderer),
            ]
        );
    }

    #[Route(route: '/spiral-view', name: 'spiral-view', methods: 'GET')]
    public function spiralViewRenderer(SpiralViewRenderer $spiralViewRenderer): string
    {
        return $spiralViewRenderer->render(
            'base',
            [
                'title' => 'Render using: ' . get_class($spiralViewRenderer),
            ]
        );
    }
}
