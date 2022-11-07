<?php

declare(strict_types=1);

namespace App\Handler;

use Laminas\Diactoros\Response\HtmlResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Schranz\Templating\Adapter\Blade\BladeRenderer;

class TemplateBladeHandler implements RequestHandlerInterface
{
    public function __construct(private BladeRenderer $bladeRenderer)
    {}

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        return new HtmlResponse($this->bladeRenderer->render(
            'base',
            [
                'title' => 'Render using: ' . get_class($this->bladeRenderer),
            ]
        ));
    }
}
