<?php

return [

    'storage' => [
        'driver' => '',

        'uploads' => storage_path('app/jecar/uploads'),
        'cache' => storage_path('app/jecar/cache'),
    ],

    'database' => [
        'table_prefix' => env('DB_PREFIX', null),
    ],
];
