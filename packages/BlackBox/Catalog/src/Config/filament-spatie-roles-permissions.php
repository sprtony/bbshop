<?php

return [

    'generator' => [

        'model_directories' => [
            __DIR__ . '../Models/',
        ],

        'custom_models' => [],

        'excluded_models' => [],

        'excluded_policy_models' => [
            BlackBox\Admin\Models\Admin::class,
        ],

        'custom_permissions' => [],
    ],
];
