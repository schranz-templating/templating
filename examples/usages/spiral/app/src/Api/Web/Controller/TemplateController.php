<?php

declare(strict_types=1);

namespace App\Api\Web\Controller;

use Schranz\Templating\Adapter\Twig\TwigRenderer;
use Schranz\Templating\TemplateRenderer\TemplateRendererInterface;
use Spiral\Router\Annotation\Route;

class TemplateController
{
    #[Route(route: '/', name: 'index', methods: 'GET')]
    public function index(?TemplateRendererInterface $defaultRenderer = null): string
    {
        return
            '<h1>Goto /twig</h1>' .
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
}
