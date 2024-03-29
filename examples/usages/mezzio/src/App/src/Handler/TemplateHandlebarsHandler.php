<?php

declare(strict_types=1);

namespace App\Handler;

use Laminas\Diactoros\Response\HtmlResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Schranz\Templating\Adapter\Handlebars\HandlebarsRenderer;

class TemplateHandlebarsHandler implements RequestHandlerInterface
{
    public function __construct(private HandlebarsRenderer $handlebarsRenderer)
    {}

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        return new HtmlResponse($this->handlebarsRenderer->render(
            'base.handlebars',
            [
                'title' => 'Render using: ' . get_class($this->handlebarsRenderer),
            ]
        ));
    }
}
