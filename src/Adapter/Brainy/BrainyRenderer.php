<?php

namespace Schranz\Templating\Adapter\Brainy;

use Box\Brainy\Brainy;
use Schranz\Templating\TemplateRenderer\TemplateRendererInterface;

class BrainyRenderer implements TemplateRendererInterface
{
    /**
     * @var Brainy
     */
    private $brainy;

    public function __construct(Brainy $brainy) {
        $this->brainy = $brainy;
    }

    public function render(string $template, array $context): string
    {
        foreach ($context as $key => $value) {
            $this->brainy->assign($key, $value);
        }

        return $this->brainy->fetch($template);
    }
}
