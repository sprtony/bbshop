<?php

namespace App\Policies;

use BlackBox\Admin\Models\Admin;
use Spatie\Permission\Models\Role;
use Illuminate\Auth\Access\HandlesAuthorization;

class RolePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the admin can view any models.
     *
     * @param  \BlackBox\Admin\Models\Admin  $admin
     * @return bool
     */
    public function viewAny(Admin $admin): bool
    {
        return $admin->can('view_any_role');
    }

    /**
     * Determine whether the admin can view the model.
     *
     * @param  \BlackBox\Admin\Models\Admin  $admin
     * @param  \Spatie\Permission\Models\Role  $role
     * @return bool
     */
    public function view(Admin $admin, Role $role): bool
    {
        return $admin->can('view_role');
    }

    /**
     * Determine whether the admin can create models.
     *
     * @param  \BlackBox\Admin\Models\Admin  $admin
     * @return bool
     */
    public function create(Admin $admin): bool
    {
        return $admin->can('create_role');
    }

    /**
     * Determine whether the admin can update the model.
     *
     * @param  \BlackBox\Admin\Models\Admin  $admin
     * @param  \Spatie\Permission\Models\Role  $role
     * @return bool
     */
    public function update(Admin $admin, Role $role): bool
    {
        return $admin->can('update_role');
    }

    /**
     * Determine whether the admin can delete the model.
     *
     * @param  \BlackBox\Admin\Models\Admin  $admin
     * @param  \Spatie\Permission\Models\Role  $role
     * @return bool
     */
    public function delete(Admin $admin, Role $role): bool
    {
        return $admin->can('delete_role');
    }

    /**
     * Determine whether the admin can bulk delete.
     *
     * @param  \BlackBox\Admin\Models\Admin  $admin
     * @return bool
     */
    public function deleteAny(Admin $admin): bool
    {
        return $admin->can('delete_any_role');
    }

    /**
     * Determine whether the admin can permanently delete.
     *
     * @param  \BlackBox\Admin\Models\Admin  $admin
     * @param  \Spatie\Permission\Models\Role  $role
     * @return bool
     */
    public function forceDelete(Admin $admin, Role $role): bool
    {
        return $admin->can('{{ ForceDelete }}');
    }

    /**
     * Determine whether the admin can permanently bulk delete.
     *
     * @param  \BlackBox\Admin\Models\Admin  $admin
     * @return bool
     */
    public function forceDeleteAny(Admin $admin): bool
    {
        return $admin->can('{{ ForceDeleteAny }}');
    }

    /**
     * Determine whether the admin can restore.
     *
     * @param  \BlackBox\Admin\Models\Admin  $admin
     * @param  \Spatie\Permission\Models\Role  $role
     * @return bool
     */
    public function restore(Admin $admin, Role $role): bool
    {
        return $admin->can('{{ Restore }}');
    }

    /**
     * Determine whether the admin can bulk restore.
     *
     * @param  \BlackBox\Admin\Models\Admin  $admin
     * @return bool
     */
    public function restoreAny(Admin $admin): bool
    {
        return $admin->can('{{ RestoreAny }}');
    }

    /**
     * Determine whether the admin can replicate.
     *
     * @param  \BlackBox\Admin\Models\Admin  $admin
     * @param  \Spatie\Permission\Models\Role  $role
     * @return bool
     */
    public function replicate(Admin $admin, Role $role): bool
    {
        return $admin->can('{{ Replicate }}');
    }

    /**
     * Determine whether the admin can reorder.
     *
     * @param  \BlackBox\Admin\Models\Admin  $admin
     * @return bool
     */
    public function reorder(Admin $admin): bool
    {
        return $admin->can('{{ Reorder }}');
    }

}
