<?php

namespace BlackBox\Catalog\Policies;

use BlackBox\Admin\Models\Admin;
use BlackBox\Catalog\Models\Product;

class ProductPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(Admin $user): bool
    {
        return $user->can('view-any Product');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(Admin $user): bool
    {
        return $user->can('create Product');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(Admin $user, Product $product): bool
    {
        return $user->can('update Product');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(Admin $user, Product $product): bool
    {
        return $user->can('delete Product');
    }
}
