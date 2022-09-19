<?php

declare(strict_types=1);

namespace App\Handler;

use Laminas\Diactoros\Response\HtmlResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Schranz\Templating\Adapter\Twig\TwigRenderer;
use Schranz\Templating\TemplateRenderer\TemplateRendererInterface;

class TemplateTwigHandler implements RequestHandlerInterface
{
    public function __construct(private TwigRenderer $twigRenderer)
    {}

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        return new HtmlResponse($this->twigRenderer->render(
            'base.html.twig',
            [
                'title' => 'Render using: ' . get_class($this->twigRenderer),
            ]
        ));
    }
}
