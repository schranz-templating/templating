<?php

namespace Application\Controller;

use Laminas\Http\Response;
use Laminas\Mvc\Controller\AbstractActionController;
use Schranz\Templating\Bridge\Handlebars\HandlebarsRenderer;
use Schranz\Templating\Bridge\Latte\LatteRenderer;
use Schranz\Templating\Bridge\Mustache\MustacheRenderer;
use Schranz\Templating\Bridge\Plates\PlatesRenderer;
use Schranz\Templating\Bridge\Smarty\SmartyRenderer;
use Schranz\Templating\TemplateRenderer\TemplateRendererInterface;

class TemplateController extends AbstractActionController
{
    public function __construct(
        private TemplateRendererInterface $defaultRenderer,
        private HandlebarsRenderer $handlebarsRenderer,
        private LatteRenderer $latteRenderer,
        private MustacheRenderer $mustacheRenderer,
        private PlatesRenderer $platesRenderer,
        private SmartyRenderer $smartyRenderer,
    ) {
    }

    public function homeAction(): Response
    {
        $response = new Response();
        $response->setContent(
            '<h1>Goto /handlebars, /latte, /mustache, /plates, /smarty, more ...</h1>' .
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

    public function latteRendererAction(): Response
    {
        $response = new Response();
        $response->setContent($this->latteRenderer->render(
            'base.latte',
            [
                'title' => 'Render using: ' . get_class($this->latteRenderer),
            ]
        ));

        return $response;
    }

    public function mustacheRendererAction(): Response
    {
        $response = new Response();
        $response->setContent($this->mustacheRenderer->render(
            'base',
            [
                'title' => 'Render using: ' . get_class($this->mustacheRenderer),
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

    public function smartyRendererAction(): Response
    {
        $response = new Response();
        $response->setContent($this->smartyRenderer->render(
            'base.tpl',
            [
                'title' => 'Render using: ' . get_class($this->smartyRenderer),
            ]
        ));

        return $response;
    }
}
