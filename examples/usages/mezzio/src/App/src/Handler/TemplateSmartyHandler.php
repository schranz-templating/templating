<?php

declare(strict_types=1);

namespace App\Handler;

use Laminas\Diactoros\Response\HtmlResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Schranz\Templating\Adapter\Smarty\SmartyRenderer;

class TemplateSmartyHandler implements RequestHandlerInterface
{
    public function __construct(private SmartyRenderer $smartyRenderer)
    {}

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        return new HtmlResponse($this->smartyRenderer->render(
            'base.tpl',
            [
                'title' => 'Render using: ' . get_class($this->smartyRenderer),
            ]
        ));
    }
}
