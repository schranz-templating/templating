<?php

namespace Schranz\Templating\Adapter\SpiralView;

use Schranz\Templating\TemplateRenderer\TemplateRendererInterface;
use Spiral\Views\ViewsInterface;

class SpiralViewRenderer implements TemplateRendererInterface
{
    /**
     * @var ViewsInterface
     */
    private $views;

    public function __construct(ViewsInterface $views)
    {
        $this->views = $views;
    }

    public function render(string $template, array $context): string
    {
        return $this->views->get($template)->render($context);
    }
}
