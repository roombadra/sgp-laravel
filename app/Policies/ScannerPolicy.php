<?php

namespace App\Policies;

use App\Models\Module;
use App\Models\ModulePermission;
use App\Models\Scanner;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ScannerPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        $has_permissions = ModulePermission::forProfile($user->profile_id)
            ->forModule(Module::SCANNER)
            ->first();
        return $has_permissions && $has_permissions->can_fetch;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user): bool
    {
        $has_permissions = ModulePermission::forProfile($user->profile_id)
            ->forModule(Module::SCANNER)
            ->first();

        return $has_permissions && $has_permissions->can_read;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        $has_permissions = ModulePermission::forProfile($user->profile_id)
            ->forModule(Module::SCANNER)
            ->first();

        return $has_permissions && $has_permissions->can_create;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user): bool
    {
        $has_permissions = ModulePermission::forProfile($user->profile_id)
            ->forModule(Module::SCANNER)
            ->first();

        return $has_permissions && $has_permissions->can_update;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user): bool
    {
        $has_permissions = ModulePermission::forProfile($user->profile_id)
            ->forModule(Module::SCANNER)
            ->first();

        return $has_permissions && $has_permissions->can_delete;
    }

}