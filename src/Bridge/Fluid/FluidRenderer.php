<?php

namespace Schranz\Templating\Bridge\Fluid;

use Schranz\Templating\TemplateRenderer\TemplateRendererInterface;
use TYPO3Fluid\Fluid\View\AbstractTemplateView;

class FluidRenderer implements TemplateRendererInterface
{
    /**
     * @var AbstractTemplateView
     */
    private $fluid;

    public function __construct(AbstractTemplateView $fluid)
    {
        $this->fluid = $fluid;
    }

    public function render(string $template, array $context): string
    {
        foreach ($context as $key => $value) {
            $this->fluid->assign($key, $value);
        }

        return $this->fluid->render($template);
    }
}
