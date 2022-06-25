<?php

namespace Schranz\Templating\Bridge\Qiq;

use Qiq\TemplateCore;
use Schranz\Templating\TemplateRenderer\TemplateRendererInterface;

class QiqRenderer implements TemplateRendererInterface
{
    /**
     * @var TemplateCore
     */
    private $qiq;

    public function __construct(TemplateCore $qiq) {
        $this->qiq = $qiq;
    }

    public function render(string $template, array $context): string
    {
        return $this->qiq->render($template, $context);
    }
}
