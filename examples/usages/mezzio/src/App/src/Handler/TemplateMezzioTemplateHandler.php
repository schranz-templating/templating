<?php

declare(strict_types=1);

namespace App\Handler;

use Laminas\Diactoros\Response\HtmlResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Schranz\Templating\Adapter\MezzioTemplate\MezzioTemplateRenderer;

class TemplateMezzioTemplateHandler implements RequestHandlerInterface
{
    public function __construct(private MezzioTemplateRenderer $mezzioTemplateRenderer)
    {}

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        return new HtmlResponse($this->mezzioTemplateRenderer->render(
            'base',
            [
                'title' => 'Render using: ' . get_class($this->mezzioTemplateRenderer),
            ]
        ));
    }
}
