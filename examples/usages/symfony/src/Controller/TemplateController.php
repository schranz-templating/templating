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
        return new Response($defaultRenderer->render(
            'base.html.twig',
            [
                'title' => 'Goto /twig or /blade',
            ]
        ));
    }

    /**
     * @Route("/blade", name="blade")
     */
    public function defaultRenderer(TemplateRendererInterface $bladeRenderer): Response
    {
        return new Response($bladeRenderer->render(
            'base',
            [
                'title' => 'Render using: ' . get_class($bladeRenderer),
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
