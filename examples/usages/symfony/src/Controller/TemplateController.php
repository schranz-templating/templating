<?php

namespace App\Controller;

use Schranz\Templating\TemplateRenderer\TemplateRendererInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TemplateController
{
    /**
     * @Route("/", name="home")
     */
    public function home(TemplateRendererInterface $defaultRenderer): Response
    {
        return new Response(
            '<h1>Goto /blade, /handlebars /latte, /mustache, /plates, /smarty, /twig</h1>' .
            '<p>Default Renderer is: ' . get_class($defaultRenderer) . '</p>'
        );
    }

    /**
     * @Route("/blade", name="blade")
     */
    public function bladeRenderer(TemplateRendererInterface $bladeRenderer): Response
    {
        return new Response($bladeRenderer->render(
            'base',
            [
                'title' => 'Render using: ' . get_class($bladeRenderer),
            ]
        ));
    }

    /**
     * @Route("/handlebars", name="handlebars")
     */
    public function handlebarsRenderer(TemplateRendererInterface $handlebarsRenderer): Response
    {
        return new Response($handlebarsRenderer->render(
            'base.handlebars',
            [
                'title' => 'Render using: ' . get_class($handlebarsRenderer),
            ]
        ));
    }

    /**
     * @Route("/latte", name="latte")
     */
    public function latteRenderer(TemplateRendererInterface $latteRenderer): Response
    {
        return new Response($latteRenderer->render(
            'base.latte',
            [
                'title' => 'Render using: ' . get_class($latteRenderer),
            ]
        ));
    }

    /**
     * @Route("/mustache", name="mustache")
     */
    public function mustacheRenderer(TemplateRendererInterface $mustacheRenderer): Response
    {
        return new Response($mustacheRenderer->render(
            'base',
            [
                'title' => 'Render using: ' . get_class($mustacheRenderer),
            ]
        ));
    }

    /**
     * @Route("/plates", name="plates")
     */
    public function platesRenderer(TemplateRendererInterface $platesRenderer): Response
    {
        return new Response($platesRenderer->render(
            'base.plates',
            [
                'title' => 'Render using: ' . get_class($platesRenderer),
            ]
        ));
    }

    /**
     * @Route("/smarty", name="smarty")
     */
    public function smartyRenderer(TemplateRendererInterface $smartyRenderer): Response
    {
        return new Response($smartyRenderer->render(
            'base.tpl',
            [
                'title' => 'Render using: ' . get_class($smartyRenderer),
            ]
        ));
    }

    /**
     * @Route("/twig", name="twig")
     */
    public function twigRenderer(TemplateRendererInterface $twigRenderer): Response
    {
        return new Response($twigRenderer->render(
            'base.html.twig',
            [
                'title' => 'Render using: ' . get_class($twigRenderer),
            ]
        ));
    }
}
