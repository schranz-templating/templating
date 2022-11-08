<?php

declare(strict_types=1);

namespace App\Api\Web\Controller;

use Schranz\Templating\TemplateRenderer\TemplateRendererInterface;
use Spiral\Router\Annotation\Route;

class TemplateController
{
    public function __construct(
        private ?TemplateRendererInterface $defaultRenderer
    ) {
    }

    #[Route(route: '/', name: 'index', methods: 'GET')]
    public function index(): string
    {
        return
            '<h1>Goto /</h1>' .
            '<p>Default Renderer is: ' . get_debug_type($this->defaultRenderer) . '</p>'
        ;
    }
}
