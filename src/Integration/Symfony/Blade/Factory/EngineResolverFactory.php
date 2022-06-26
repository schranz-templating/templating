<?php

namespace Schranz\Templating\Integration\Symfony\Blade\Factory;

use Illuminate\Filesystem\Filesystem;
use Illuminate\View\Compilers\BladeCompiler;
use Illuminate\View\Engines\CompilerEngine;
use Illuminate\View\Engines\PhpEngine;

/**
 * @internal
 */
class EngineResolverFactory
{
    public static function createBladeEngineClosure(Filesystem $filesystem, BladeCompiler $bladeCompiler): \Closure
    {
        return function () use ($bladeCompiler, $filesystem) {
            return new CompilerEngine($bladeCompiler, $filesystem);
        };
    }

    public static function createPhpEngineClosure(Filesystem $filesystem): \Closure
    {
        return function () use ($filesystem) {
            return new PhpEngine($filesystem);
        };
    }
}
