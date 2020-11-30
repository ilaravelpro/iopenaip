<?php

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
