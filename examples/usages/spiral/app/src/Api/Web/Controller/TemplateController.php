<?php

declare(strict_types=1);

namespace App\Api\Web\Controller;

use Schranz\Templating\Adapter\Handlebars\HandlebarsRenderer;
use Schranz\Templating\Adapter\Mustache\MustacheRenderer;
use Schranz\Templating\Adapter\Smarty\SmartyRenderer;
use Schranz\Templating\Adapter\Twig\TwigRenderer;
use Schranz\Templating\TemplateRenderer\TemplateRendererInterface;
use Spiral\Router\Annotation\Route;

class TemplateController
{
    #[Route(route: '/', name: 'index', methods: 'GET')]
    public function index(?TemplateRendererInterface $defaultRenderer = null): string
    {
        return
            '<h1>Goto /twig, /smarty, /handlebars, /mustache</h1>' .
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
}
