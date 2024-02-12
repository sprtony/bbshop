<?php

namespace Quimaira\Catalog\Policies;

use App\Models\Admin;
use Quimaira\Catalog\Models\Category;

class CategoryPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(Admin $user): bool
    {
        return $user->can('view-any Category');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(Admin $user): bool
    {
        return $user->can('create Category');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(Admin $user, Category $category): bool
    {
        return $user->can('update Category');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(Admin $user, Category $category): bool
    {
        return $user->can('delete Category');
    }
}
