<?php

namespace Schranz\Templating\Adapter\Handlebars;

use Handlebars\Handlebars;
use Schranz\Templating\TemplateRenderer\TemplateRendererInterface;

class HandlebarsRenderer implements TemplateRendererInterface
{
    /**
     * @var Handlebars
     */
    private $handlebars;

    public function __construct(Handlebars $handlebars)
    {
        $this->handlebars = $handlebars;
    }

    public function render(string $template, array $context): string
    {
        return $this->handlebars->render($template, $context);
    }
}
