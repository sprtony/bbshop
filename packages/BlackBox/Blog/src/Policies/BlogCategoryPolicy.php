<?php

namespace Quimaira\Blog\Policies;

use App\Models\Admin;
use Quimaira\Blog\Models\BlogCategory;

class BlogCategoryPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(Admin $user): bool
    {
        return $user->can('view-any BlogCategory');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(Admin $user): bool
    {
        return $user->can('create BlogCategory');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(Admin $user, BlogCategory $category): bool
    {
        return $user->can('update BlogCategory');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(Admin $user, BlogCategory $category): bool
    {
        return $user->can('delete BlogCategory');
    }
}
