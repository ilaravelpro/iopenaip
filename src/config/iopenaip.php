<?php
/**
 * Author: Amir Hossein Jahani | iAmir.net
 * Last modified: 11/28/20, 8:30 PM
 * Copyright (c) 2021. Powered by iamir.net
 */

return [
    'routes' => [
        'api' => [
            'status' => true,
            'auth' => true,
        ]
    ],
    'policies' => [
        'airports' => true
    ],
    'database' => [
        'migrations' => [
            'include' => true
        ],
    ],
];
?>
