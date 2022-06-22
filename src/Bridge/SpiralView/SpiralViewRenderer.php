<?php

namespace Schranz\Templating\Bridge\SpiralView;

use Schranz\Templating\TemplateRenderer\TemplateRendererInterface;
use Spiral\Views\EngineInterface;
use Spiral\Views\ViewContext;

class SpiralViewRenderer implements TemplateRendererInterface
{
    /**
     * @var EngineInterface
     */
    private $spiralView;

    public function __construct(EngineInterface $spiralView)
    {
        $this->spiralView = $spiralView;
    }

    public function render(string $template, array $context): string
    {
        return $this->spiralView->get($template, new ViewContext())->render($context);
    }
}
