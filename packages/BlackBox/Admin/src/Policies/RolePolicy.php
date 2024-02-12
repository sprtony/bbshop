<?php

namespace App\Policies;

use App\Models\Role;
use App\Models\Admin;

class RolePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(Admin $user): bool
    {
        return $user->can('view-any Role');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(Admin $user): bool
    {
        return $user->can('create Role');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(Admin $user, Role $role): bool
    {
        return $user->can('update Role');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(Admin $user, Role $role): bool
    {
        return $user->can('delete Role');
    }
}
