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
                'title' => 'Goto /blade, /latte, /smarty, /twig',
            ]
        ));
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
