<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Cache directory
    |--------------------------------------------------------------------------
    |
    | Using directory for the cache files of mustache templating files.
    */

    'cache' => env(
        'VIEW_COMPILED_PATH',
        realpath(storage_path('framework/views'))
    ) . '/mustache',

    /*
    |--------------------------------------------------------------------------
    | Path
    |--------------------------------------------------------------------------
    |
    | Directory where the mustache templates can be found.
    */

    'path' => resource_path('views'),
];
