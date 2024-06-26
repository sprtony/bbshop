<?php

namespace App\Policies;

use BlackBox\Admin\Models\Admin;

class BannerPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(Admin $user): bool
    {
        return $user->can('view-any Banner');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(Admin $user): bool
    {
        return $user->can('create Banner');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(Admin $user): bool
    {
        return $user->can('update Banner');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(Admin $user): bool
    {
        return $user->can('delete Banner');
    }
}
