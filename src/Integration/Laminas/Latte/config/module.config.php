<?php

namespace Schranz\Templating\Integration\Laminas\Latte;

return [
    'schranz_templating_latte' => [
        'cache' => 'data/cache/latte',
        'path' => 'module/Application/view',
        'extensions' => [
            // list of service names implementing \Latte\Extension for extending latte
        ],
    ],
];
