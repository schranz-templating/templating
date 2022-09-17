<?php

namespace Schranz\Templating\Adapter\YiiView;

use Schranz\Templating\TemplateRenderer\TemplateRendererInterface;
use Yiisoft\View\View;

class YiiViewRenderer implements TemplateRendererInterface
{
    /**
     * @var View
     */
    private $yiiView;

    public function __construct(
        View $yiiView
    ) {
        $this->yiiView = $yiiView;
    }

    public function render(string $template, array $context): string
    {
        return $this->yiiView->renderFile($template, $context);
    }
}
