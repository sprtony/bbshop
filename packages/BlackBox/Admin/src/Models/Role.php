<?php

namespace Quimaira\Admin\Models;

use Spatie\Permission\Models\Role as RoleModel;

class Role extends RoleModel
{
    protected $attributes = [
        'guard_name' => 'admin',
    ];
}
