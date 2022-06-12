<?php

namespace Schranz\Templating\Bridge\Mezzio;

use Mezzio\Template\TemplateRendererInterface as MezzioTemplateRendererInterface;
use Schranz\Templating\TemplateRenderer\TemplateRendererInterface;

class MezzioRenderer implements TemplateRendererInterface
{
    /**
     * @var MezzioTemplateRendererInterface
     */
    private $mezzio;

    public function __construct(MezzioTemplateRendererInterface $mezzio)
    {
        $this->mezzio = $mezzio;
    }

    public function render(string $template, array $context): string
    {
        return $this->mezzio->render($template, $context);
    }
}
