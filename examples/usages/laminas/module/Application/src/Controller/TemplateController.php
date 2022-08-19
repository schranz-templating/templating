<?php

namespace Application\Controller;

use Laminas\Http\Response;
use Laminas\Mvc\Controller\AbstractActionController;
use Schranz\Templating\Bridge\Handlebars\HandlebarsRenderer;
use Schranz\Templating\Bridge\Plates\PlatesRenderer;
use Schranz\Templating\TemplateRenderer\TemplateRendererInterface;

class TemplateController extends AbstractActionController
{
    public function __construct(
        private TemplateRendererInterface $defaultRenderer,
        private HandlebarsRenderer $handlebarsRenderer,
        private PlatesRenderer $platesRenderer,
    ) {
    }

    public function homeAction(): Response
    {
        $response = new Response();
        $response->setContent(
            '<h1>Goto /handlebars, /plates, more ...</h1>' .
            '<p>Default Renderer is: ' . get_class($this->defaultRenderer) . '</p>'
        );

        return $response;
    }

    public function handlebarsRendererAction(): Response
    {
        $response = new Response();
        $response->setContent($this->handlebarsRenderer->render(
            'base',
            [
                'title' => 'Render using: ' . get_class($this->handlebarsRenderer),
            ]
        ));

        return $response;
    }

    public function platesRendererAction(): Response
    {
        $response = new Response();
        $response->setContent($this->platesRenderer->render(
            'base.plates',
            [
                'title' => 'Render using: ' . get_class($this->platesRenderer),
            ]
        ));

        return $response;
    }
}
