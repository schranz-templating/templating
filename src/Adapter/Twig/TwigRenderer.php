<?php

namespace Schranz\Templating\Adapter\Twig;

use Schranz\Templating\TemplateRenderer\TemplateRendererInterface;
use Twig\Environment;

class TwigRenderer implements TemplateRendererInterface
{
    /**
     * @var Environment
     */
    private $twig;

    public function __construct(Environment $twig) {
        $this->twig = $twig;
    }

    public function render(string $template, array $context): string
    {
        return $this->twig->render($template, $context);
    }
}
