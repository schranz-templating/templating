<?php

namespace Schranz\Templating\Bridge\Plates;

use League\Plates\Engine;
use Schranz\Templating\TemplateRenderer\TemplateRendererInterface;

class PlatesRenderer implements TemplateRendererInterface
{
    /**
     * @var Engine
     */
    private $plates;

    public function __construct(Engine $plates)
    {
        $this->plates = $plates;
    }

    public function render(string $template, array $context): string
    {
        return $this->plates->render($template, $context);
    }
}
