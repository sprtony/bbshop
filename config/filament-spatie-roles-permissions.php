<?php

return [

    'preload_roles' => true,

    'preload_permissions' => true,

    'navigation_section_group' => 'control de accesos', // Default uses language constant

    'team_model' => \App\Models\Team::class,

    /*
     * Set to false to remove from navigation
     */
    'should_register_on_navigation' => [
        'permissions' => true,
        'roles' => true,
    ],

    'guard_names' => [
        'admin' => 'admin',
    ],

    'toggleable_guard_names' => [
        'roles' => [
            'isToggledHiddenByDefault' => true,
        ],
        'permissions' => [
            'isToggledHiddenByDefault' => true,
        ],
    ],

    'default_guard_name' => 'admin',

    'model_filter_key' => 'return \'%\'.$key;', // Eg: 'return \'%\'.$key.'\%\';'

    'generator' => [

        'guard_names' => [
            'admin',
        ],

        'permission_affixes' => [

            /*
             * Permissions Aligned with Policies.
             * DO NOT change the keys unless the genericPolicy.stub is published and altered accordingly
             */
            'viewAnyPermission' => 'view-any',
            'createPermission' => 'create',
            'updatePermission' => 'update',
            'deletePermission' => 'delete',

            /*
             * Additional Resource Permissions
             */
        ],

        /*
         * returns the "name" for the permission.
         *
         * $permission which is an iteration of [permission_affixes] ,
         * $model The model to which the $permission will be concatenated
         *
         * Eg: 'permission_name' => 'return $permissionAffix . ' ' . Str::kebab($modelName),
         *
         * Note: If you are changing the "permission_name" , It's recommended to run with --clean to avoid duplications
         */
        'permission_name' => 'return $permissionAffix . \' \' . $modelName;',

        /*
         * Permissions will be generated for the models associated with the respective Filament Resources
         */
        'discover_models_through_filament_resources' => false,

        /*
         * Include directories which consists of models.
         */
        'model_directories' => [
            app_path('Models'),
        ],

        /*
         * Define custom_models in snake-case
         */
        'custom_models' => [
            //
        ],

        /*
         * Define excluded_models in snake-case
         */
        'excluded_models' => [
            \App\Models\PostalCode::class,
        ],

        'excluded_policy_models' => [
            \App\Models\User::class,
        ],

        /*
         * Define any other permission here
         */
        'custom_permissions' => [
            //'view-log'
        ],

        'user_model' => BlackBox\Admin\Models\Admin::class,

        'policies_namespace' => 'App\Policies',
    ],
];
