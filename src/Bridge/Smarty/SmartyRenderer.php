<?php

namespace Schranz\Templating\Bridge\Smarty;

use Schranz\Templating\TemplateRenderer\TemplateRendererInterface;
use Smarty;

class SmartyRenderer implements TemplateRendererInterface
{
    /**
     * @var Smarty
     */
    private $smarty;

    public function __construct(Smarty $smarty) {
        $this->smarty = $smarty;
    }

    public function render(string $template, array $context): string
    {
        // Smarty does not support render to string, so the mechanism from twig is used to render it into a string:
        //      https://github.com/twigphp/Twig/blob/b6017005b3f6cfc476a976d7cfd57c038f183569/src/Template.php#L370-L389
        $level = ob_get_level();
        ob_start(function () { return ''; });

        try {
            $this->smarty->display($template);
        } catch (\Throwable $e) {
            while (ob_get_level() > $level) {
                ob_end_clean();
            }

            throw $e;
        }

        return ob_get_clean();
    }
}
