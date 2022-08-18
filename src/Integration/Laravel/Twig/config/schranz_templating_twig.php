<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Cache directory
    |--------------------------------------------------------------------------
    |
    | Using directory for the cache files of twig templating files.
    */

    'cache' => env(
        'VIEW_COMPILED_PATH',
        realpath(storage_path('framework/views'))
    ) . '/twig',

    /*
    |--------------------------------------------------------------------------
    | Paths
    |--------------------------------------------------------------------------
    |
    | Directory where the twig templates can be found.
    */
    'paths' => resource_path('views'),

    /*
    |--------------------------------------------------------------------------
    | Strict Variables
    |--------------------------------------------------------------------------
    |
    | Defines if twig run in strict variables mode recommended for only development.
    */

    'strict_variables' => env('APP_DEBUG', false),

    /*
    |--------------------------------------------------------------------------
    | Debug
    |--------------------------------------------------------------------------
    |
    | Defines if twig runs in debug mode.
    */

    'debug' => env('APP_DEBUG', false),

    /*
    |--------------------------------------------------------------------------
    | Optimizations
    |--------------------------------------------------------------------------
    |
    | Optimizations the -1 enables all optimizations which is recommended.
    */

    'optimizations' => -1,
];
