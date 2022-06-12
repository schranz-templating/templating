<?php

namespace Schranz\Templating\TemplateRenderer;

interface TemplateRendererInterface
{
    /**
     * The render method
     *
     * @param string $template
     * @param array<string, mixed> $context
     *
     * @return string
     */
    public function render(string $template, array $context): string;
}
