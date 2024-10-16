<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Module;
use App\Models\ModulePermission;

class UserPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        $has_permission = ModulePermission::forProfile($user->profile_id)
            ->forModule(Module::USER)
            ->first();
        return $has_permission && $has_permission->can_fetch;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user): bool
    {
        $has_permission = ModulePermission::forProfile($user->profile_id)
            ->forModule(Module::USER)
            ->first();
        return $has_permission && $has_permission->can_read;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        $has_permission = ModulePermission::forProfile($user->profile_id)
            ->forModule(Module::USER)
            ->first();
        return $has_permission && $has_permission->can_create;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user): bool
    {
        $has_permission = ModulePermission::forProfile($user->profile_id)
            ->forModule(Module::USER)
            ->first();
        return $has_permission && $has_permission->can_update;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user): bool
    {
        $has_permission = ModulePermission::forProfile($user->profile_id)
            ->forModule(Module::USER)
            ->first();
        return $has_permission && $has_permission->can_delete;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, User $model)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, User $model)
    {
        //
    }
}