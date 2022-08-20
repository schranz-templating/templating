<?php

namespace Schranz\Templating\Integration\Laminas\Twig;

return [
    'schranz_templating_twig' => [
        'cache' => 'data/cache/twig',
        'paths' => [
            'module/Application/view'
        ],
        'extensions' => [
            // list of service names implementing \Twig\Extension for extending twig
        ],
        'debug' => null, // recommended false for prod and true for dev default to debug container variable
        'strict_variables' => null, // recommended false for prod and true for dev default to debug container variable
        'optimizations' => -1, // recommended -1 which enables all optimizations
    ],
];
