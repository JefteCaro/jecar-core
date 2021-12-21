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
         *
         */
        'driver' => 'redis',

        /**
         * Public files upload directory and cache directory
         * https://glide.thephpleague.com/
         *
         *
         */
        'uploads' => 'app/public/uploads',
        'cache' => 'app/cache',
    ],

    /**
     * Table prefix
     *
     * Recommended for existing projects
     */
    'database' => [
        'table_prefix' => env('DB_PREFIX', null),
    ],

    'subdomains' => [
        'cms' => '',
    ],

    'paths' => [
        'cms' => 'content',
    ],

    'modules' => [
        /**
         * Enable modules for CMS
         *
         * $ composer require jecar/cms
         *
         * Create a list of Models with string representation
         * CMS will use this list as reference for dynamically creating pages
         *
         * 'user' => \App\Models\Users::class,
         *
         */
        'cms' => [
            // 'user' => \App\Models\Users::class,
        ],
    ],
];
