<?php

declare(strict_types=1);

namespace App\Handler;

use Laminas\Diactoros\Response\HtmlResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Schranz\Templating\Adapter\Mezzio\MezzioRenderer;

class TemplateMezzioHandler implements RequestHandlerInterface
{
    public function __construct(private MezzioRenderer $mezzioRenderer)
    {}

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        return new HtmlResponse($this->mezzioRenderer->render(
            'base',
            [
                'title' => 'Render using: ' . get_class($this->mezzioRenderer),
            ]
        ));
    }
}
