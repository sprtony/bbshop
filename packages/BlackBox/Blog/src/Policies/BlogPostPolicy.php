<?php

namespace Quimaira\Blog\Policies;

use App\Models\Admin;
use Quimaira\Blog\Models\BlogPost;

class BlogPostPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(Admin $user): bool
    {
        return $user->can('view-any BlogPost');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(Admin $user): bool
    {
        return $user->can('create BlogPost');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(Admin $user, BlogPost $post): bool
    {
        return $user->can('update BlogPost');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(Admin $user, BlogPost $post): bool
    {
        return $user->can('delete BlogPost');
    }
}
