<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Cache directory
    |--------------------------------------------------------------------------
    |
    | Using directory for the cache files of latte templating files.
    */

    'cache' => env(
        'VIEW_COMPILED_PATH',
        realpath(storage_path('framework/views'))
    ) . '/latte',

    /*
    |--------------------------------------------------------------------------
    | Path
    |--------------------------------------------------------------------------
    |
    | Directory where the latte templates can be found.
    */
    'path' => resource_path('views'),
];
