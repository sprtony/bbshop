<?php

namespace App\Policies;

use App\Models\PostalCode;

class PostalCodePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view-any PostalCode');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, PostalCode $postalcode): bool
    {
        return $user->can('{{ viewPermission }}');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('create PostalCode');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, PostalCode $postalcode): bool
    {
        return $user->can('update PostalCode');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, PostalCode $postalcode): bool
    {
        return $user->can('delete PostalCode');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, PostalCode $postalcode): bool
    {
        return $user->can('{{ restorePermission }}');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, PostalCode $postalcode): bool
    {
        return $user->can('{{ forceDeletePermission }}');
    }
}
