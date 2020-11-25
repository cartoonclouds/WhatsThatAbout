<?php

/*
|--------------------------------------------------------------------------
| Website Configuration
|--------------------------------------------------------------------------
|
| A place to hold general website configuration.
|
*/

return [

    'favicon-url' => env('FAVICON_URL', ''),

    'paths' => [
        'images' => [
            'pages' => 'images/pages/',
            'scenes' => 'images/scenes/',
        ],
    ],

    'formats' => [
        'date' => 'd/m/Y', // 05/01/2017
        'full_date' => 'dS F, Y', // 5th January, 2017
        'time' => 'H:i:s', // 17:04:05
        'full_time' => 'H:i A', // 05:04 AM
        'datetime' => 'd/m/Y H:i:s', // 05/01/2017 17:04:05
        'full_datetime' => 'dS F, Y H:i A', // 5th January, 2017 05:04 AM
    ],

    'icons' => [
        'home' => 'fas fa-home',
        'users' => [
            'index' => 'fas fa-users',
            'create' => 'fas fa-user-plus',
        ],
        'pages' => [
            'index' => 'fas fa-file-alt',
            'create' => 'fas fa-file-plus',
        ],
        'scenes' => [
            'index' => 'fas fa-puzzle-piece',
            'create' => 'fas fa-plus',
        ],
        'themes' => [
            'index' => 'fas fa-monkey',
        ],
        'genres' => [
            'index' => 'fas fa-theater-masks',
        ],
        'formats' => [
            'index' => 'fas fa-camera-movie',
        ],
    ]
];
