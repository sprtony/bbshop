<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\Permission;
use App\Models\Admin;

class PermissionPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(Admin $user): bool
    {
        return $user->can('view-any Permission');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(Admin $user): bool
    {
        return $user->can('create Permission');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(Admin $user, Permission $permission): bool
    {
        return $user->can('update Permission');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(Admin $user, Permission $permission): bool
    {
        return $user->can('delete Permission');
    }
}
