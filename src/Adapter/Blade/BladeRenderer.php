<?php

namespace Schranz\Templating\Adapter\Blade;

use Illuminate\Contracts\View\Factory as FactoryContract;
use Schranz\Templating\TemplateRenderer\TemplateRendererInterface;

class BladeRenderer implements TemplateRendererInterface
{
    /**
     * @var FactoryContract
     */
    private $blade;

    public function __construct(FactoryContract $blade)
    {
        $this->blade = $blade;
    }

    public function render(string $template, array $context): string
    {
        return $this->blade->make($template, $context)->render();
    }
}
