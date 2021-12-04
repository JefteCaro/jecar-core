<?php

return [

    'storage' => [
        /**
         * Upload protocol uses tus.io
         * https://github.com/ankitpokhrel/tus-php
         *
         * You can set your caching driver to
         * 'file', or 'redis'
         *
         * Empty or null defaults to 'file'
         */
        'driver' => 'redis',

        /**
         * Public files upload directory and cache directory
         * https://glide.thephpleague.com/
         *
         *
         */
        'uploads' => storage_path('app/jecar/uploads'),
        'cache' => storage_path('app/jecar/cache'),
    ],

    /**
     * Table prefix
     *
     * Recommended for existing projects
     */
    'database' => [
        'table_prefix' => env('DB_PREFIX', null),
    ],

    'modules' => [

        'cms' => [

        ],
    ],
];
