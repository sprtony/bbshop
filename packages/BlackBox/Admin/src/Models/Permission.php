<?php

namespace Quimaira\Admin\Models;

use Spatie\Permission\Models\Permission as PermissionModel;

class Permission extends PermissionModel
{
    protected $fillable = [
        'name',
    ];

    protected $attributes = [
        'guard_name' => 'admin',
    ];
}
