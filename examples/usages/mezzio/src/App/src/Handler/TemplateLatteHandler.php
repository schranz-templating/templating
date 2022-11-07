<?php

declare(strict_types=1);

namespace App\Handler;

use Laminas\Diactoros\Response\HtmlResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Schranz\Templating\Adapter\Latte\LatteRenderer;

class TemplateLatteHandler implements RequestHandlerInterface
{
    public function __construct(private LatteRenderer $latteRenderer)
    {}

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        return new HtmlResponse($this->latteRenderer->render(
            'base.latte',
            [
                'title' => 'Render using: ' . get_class($this->latteRenderer),
            ]
        ));
    }
}
