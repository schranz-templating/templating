<?php

namespace Schranz\Templating\Adapter\PHPTAL;

use PHPTAL;
use Schranz\Templating\TemplateRenderer\TemplateRendererInterface;

class PHPTALRenderer implements TemplateRendererInterface
{
    /**
     * @var PHPTAL
     */
    private $phptal;

    public function __construct(PHPTAL $phptal)
    {
        $this->phptal = $phptal;
    }

    public function render(string $template, array $context): string
    {
        $template = clone $this->phptal;

        $template->setTemplate($template);

        foreach ($context as $key => $value) {
            $template->set($key, $value);
        }

        return $template->execute();
    }
}
