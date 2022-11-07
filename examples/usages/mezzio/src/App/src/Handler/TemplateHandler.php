<?php

declare(strict_types=1);

namespace App\Handler;

use Laminas\Diactoros\Response\HtmlResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Schranz\Templating\TemplateRenderer\TemplateRendererInterface;

class TemplateHandler implements RequestHandlerInterface
{
    public function __construct(private TemplateRendererInterface $defaultRenderer)
    {}

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        return new HtmlResponse(
            '<h1>Goto /twig, /plates, /handlebars, /mustache, /smarty</h1>' .
            '<p>Default Renderer is: ' . get_class($this->defaultRenderer) . '</p>'
        );
    }
}
