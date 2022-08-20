<?php

namespace Application\Controller;

use Laminas\Http\Response;
use Laminas\Mvc\Controller\AbstractActionController;
use Schranz\Templating\Bridge\Blade\BladeRenderer;
use Schranz\Templating\Bridge\Handlebars\HandlebarsRenderer;
use Schranz\Templating\Bridge\LaminasView\LaminasViewRenderer;
use Schranz\Templating\Bridge\Latte\LatteRenderer;
use Schranz\Templating\Bridge\Mustache\MustacheRenderer;
use Schranz\Templating\Bridge\Plates\PlatesRenderer;
use Schranz\Templating\Bridge\Smarty\SmartyRenderer;
use Schranz\Templating\Bridge\Twig\TwigRenderer;
use Schranz\Templating\TemplateRenderer\TemplateRendererInterface;

class TemplateController extends AbstractActionController
{
    public function __construct(
        private TemplateRendererInterface $defaultRenderer,
        private BladeRenderer $bladeRenderer,
        private HandlebarsRenderer $handlebarsRenderer,
        private LaminasViewRenderer $laminasViewRenderer,
        private LatteRenderer $latteRenderer,
        private MustacheRenderer $mustacheRenderer,
        private PlatesRenderer $platesRenderer,
        private SmartyRenderer $smartyRenderer,
        private TwigRenderer $twigRenderer,
    ) {
    }

    public function homeAction(): Response
    {
        $response = new Response();
        $response->setContent(
            '<h1>Goto /blade, /handlebars, /laminas-view, /latte, /mustache, /plates, /smarty, /twig</h1>' .
            '<p>Default Renderer is: ' . get_class($this->defaultRenderer) . '</p>'
        );

        return $response;
    }

    public function bladeRendererAction(): Response
    {
        $response = new Response();
        $response->setContent($this->bladeRenderer->render(
            'base',
            [
                'title' => 'Render using: ' . get_class($this->bladeRenderer),
            ]
        ));

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

    public function laminasViewRendererAction(): Response
    {
        $response = new Response();
        $response->setContent($this->laminasViewRenderer->render(
            'base',
            [
                'title' => 'Render using: ' . get_class($this->laminasViewRenderer),
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

    public function twigRendererAction(): Response
    {
        $response = new Response();
        $response->setContent($this->twigRenderer->render(
            'base.html.twig',
            [
                'title' => 'Render using: ' . get_class($this->twigRenderer),
            ]
        ));

        return $response;
    }
}
