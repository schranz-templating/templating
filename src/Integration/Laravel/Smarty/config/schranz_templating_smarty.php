<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Cache directory
    |--------------------------------------------------------------------------
    |
    | Using directory for the cache files of smarty templating files.
    */

    'cache' => env(
        'VIEW_COMPILED_PATH',
        realpath(storage_path('framework/views'))
    ) . '/smarty/cache',

    /*
    |--------------------------------------------------------------------------
    | Compile directory
    |--------------------------------------------------------------------------
    |
    | Using directory for the compile files of smarty templating files.
    */

    'compile' => env(
        'VIEW_COMPILED_PATH',
        realpath(storage_path('framework/views'))
    ) . '/smarty/compile',

    /*
    |--------------------------------------------------------------------------
    | Paths
    |--------------------------------------------------------------------------
    |
    | Directories where the smarty templates can be found.
    */
    'paths' => [
        resource_path('views'),
    ],
];
