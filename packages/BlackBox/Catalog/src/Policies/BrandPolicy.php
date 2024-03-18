<?php

namespace BlackBox\Catalog\Policies;

use BlackBox\Admin\Models\Admin;
use BlackBox\Catalog\Models\Brand;

class BrandPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(Admin $user): bool
    {
        return $user->can('view-any Brand');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(Admin $user): bool
    {
        return $user->can('create Brand');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(Admin $user, Brand $brand): bool
    {
        return $user->can('update Brand');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(Admin $user, Brand $brand): bool
    {
        return $user->can('delete Brand');
    }
}
