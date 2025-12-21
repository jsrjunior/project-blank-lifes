<?php

return [

    'paths' => [
        'users/*',
        'admin/*',
        'api/*',
    ],

    'allowed_methods' => ['GET','POST','PUT','PATCH','DELETE','OPTIONS'],

    'allowed_origins' => ['*'],

    'allowed_headers' => [
        'X-Requested-With',
        'Content-Type',
        'Authorization',
        'Origin',
        'Cache-Control'
    ],

    'supports_credentials' => true,
];
