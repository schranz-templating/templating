<?php

namespace Schranz\Templating\Bridge\LaminasView;

use Laminas\View\Renderer\RendererInterface;
use Schranz\Templating\TemplateRenderer\TemplateRendererInterface;

class LaminasViewRenderer implements TemplateRendererInterface
{
    /**
     * @var RendererInterface
     */
    private $laminasView;

    public function __construct(RendererInterface $laminasView)
    {
        $this->laminasView = $laminasView;
    }

    public function render(string $template, array $context): string
    {
        return $this->laminasView->render($template, $context);
    }
}
