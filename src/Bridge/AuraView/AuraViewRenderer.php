<?php

namespace Schranz\Templating\Bridge\AuraView;

use Aura\View\View;
use Schranz\Templating\TemplateRenderer\TemplateRendererInterface;

class AuraViewRenderer implements TemplateRendererInterface
{
    /**
     * @var View
     */
    private $auraView;

    public function __construct(View $auraView) {
        $this->auraView = $auraView;
    }

    public function render(string $template, array $context): string
    {
        return $this->auraView->render($template, $context);
    }
}
