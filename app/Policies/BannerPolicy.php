<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\Banner;

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
    public function update(Admin $user, Banner $banner): bool
    {
        return $user->can('update Banner');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(Admin $user, Banner $banner): bool
    {
        return $user->can('delete Banner');
    }
}
