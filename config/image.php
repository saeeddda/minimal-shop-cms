<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Image Driver
    |--------------------------------------------------------------------------
    |
    | Intervention Image supports "GD Library" and "Imagick" to process images
    | internally. You may choose one of them according to your PHP
    | configuration. By default PHP's "GD Library" implementation is used.
    |
    | Supported: "gd", "imagick"
    |
    */

    'driver' => 'gd',

    //image index
    'index-image-sizes' => [
        'large' => [
            'width' => 1024,
            'height' => 1024,
        ],
        'medium' => [
            'width' => 350,
            'height' => 350,
        ],
        'small' => [
            'width' => 100,
            'height' => 100,
        ]
    ],

    'default-current-index-image' => 'medium',

    //image index
    'cache-image-sizes' => [
        'large' => [
            'width' => 1024,
            'height' => 1024,
        ],
        'medium' => [
            'width' => 350,
            'height' => 350,
        ],
        'small' => [
            'width' => 100,
            'height' => 100,
        ]
    ],

    'default-current-cache-image' => 'medium',

    'image-cache-lifetime' => '10',

    'image-not-found' => '',
];
