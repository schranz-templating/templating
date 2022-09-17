<?php

namespace Schranz\Templating\Adapter\Blade;

use Illuminate\View\Factory;
use Schranz\Templating\TemplateRenderer\TemplateRendererInterface;

class BladeRenderer implements TemplateRendererInterface
{
    /**
     * @var Factory
     */
    private $blade;

    public function __construct(Factory $blade)
    {
        $this->blade = $blade;
    }

    public function render(string $template, array $context): string
    {
        return $this->blade->make($template, $context)->render();
    }
}
