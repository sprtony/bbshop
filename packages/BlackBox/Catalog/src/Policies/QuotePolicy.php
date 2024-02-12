<?php

namespace Quimaira\Catalog\Policies;

use App\Models\Admin;
use Quimaira\Catalog\Models\Quote;

class QuotePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(Admin $user): bool
    {
        return $user->can('view-any Quote');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(Admin $user): bool
    {
        return $user->can('create Quote');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(Admin $user, Quote $quote): bool
    {
        return $user->can('update Quote');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(Admin $user, Quote $quote): bool
    {
        return $user->can('delete Quote');
    }
}
