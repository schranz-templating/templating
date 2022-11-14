<?php

namespace Schranz\Templating\Adapter\MezzioTemplate;

use Mezzio\Template\TemplateRendererInterface as MezzioTemplateRendererInterface;
use Schranz\Templating\TemplateRenderer\TemplateRendererInterface;

class MezzioTemplateRenderer implements TemplateRendererInterface
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
