<?php

return [

    'generator' => [

        'model_directories' => [
            __DIR__ . '../Models/',
        ],

        'custom_models' => [],

        'excluded_models' => [],

        'excluded_policy_models' => [
            BlackBox\Customers\Models\Customer::class,
        ],

        'custom_permissions' => [],
    ],
];
