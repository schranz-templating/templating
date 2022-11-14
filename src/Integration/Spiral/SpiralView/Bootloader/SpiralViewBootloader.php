<?php

namespace Schranz\Templating\Integration\Spiral\SpiralView\Bootloader;

use Schranz\Templating\Adapter\SpiralView\SpiralViewRenderer;
use Schranz\Templating\TemplateRenderer\TemplateRendererInterface;
use Spiral\Boot\Bootloader\Bootloader;

final class SpiralViewBootloader extends Bootloader
{
    protected const DEPENDENCIES = [
        \Spiral\Views\Bootloader\ViewsBootloader::class
    ];

    protected const SINGLETONS = [
        SpiralViewRenderer::class => SpiralViewRenderer::class,
        TemplateRendererInterface::class => SpiralViewRenderer::class,
    ];
}
