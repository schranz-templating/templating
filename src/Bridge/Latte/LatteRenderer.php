<?php

namespace Schranz\Templating\Bridge\Latte;

use Latte\Engine;
use Schranz\Templating\TemplateRenderer\TemplateRendererInterface;

class LatteRenderer implements TemplateRendererInterface
{
    /**
     * @var Engine
     */
    private $latte;

    public function __construct(Engine $latte)
    {
        $this->latte = $latte;
    }

    public function render(string $template, array $context): string
    {
        return $this->latte->renderToString($template, $context);
    }
}
