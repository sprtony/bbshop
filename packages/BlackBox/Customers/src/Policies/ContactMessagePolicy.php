<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\ContactMessage;

class ContactMessagePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(Admin $user): bool
    {
        return $user->can('view-any ContactMessage');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(Admin $user, ContactMessage $contactmessage): bool
    {
        return $user->can('view ContactMessage');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(Admin $user): bool
    {
        return $user->can('create ContactMessage');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(Admin $user, ContactMessage $contactmessage): bool
    {
        return $user->can('update ContactMessage');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(Admin $user, ContactMessage $contactmessage): bool
    {
        return $user->can('delete ContactMessage');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(Admin $user, ContactMessage $contactmessage): bool
    {
        return $user->can('restore ContactMessage');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(Admin $user, ContactMessage $contactmessage): bool
    {
        return $user->can('force-delete ContactMessage');
    }
}
