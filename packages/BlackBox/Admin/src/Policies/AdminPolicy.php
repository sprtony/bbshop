<?php

namespace BlackBox\Admin\Policies;

use BlackBox\Admin\Models\Admin;

class AdminPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(Admin $user): bool
    {
        return $user->can('view_any_admin');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(Admin $user): bool
    {
        return $user->can('create_admin');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(Admin $user, Admin $admin): bool
    {
        return $user->can('update_admin');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(Admin $user, Admin $admin): bool
    {
        return $user->can('delete_admin') && ! $admin->isSuperAdmin();
    }
}
