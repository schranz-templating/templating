<?php

namespace Schranz\Templating\Adapter\Mustache;

use Mustache_Engine;
use Schranz\Templating\TemplateRenderer\TemplateRendererInterface;

class MustacheRenderer implements TemplateRendererInterface
{
    /**
     * @var Mustache_Engine
     */
    private $mustache;

    public function __construct(Mustache_Engine $mustache)
    {
        $this->mustache = $mustache;
    }

    public function render(string $template, array $context): string
    {
        return $this->mustache->render($template, $context);
    }
}
