<?php
namespace Tests\Feature\Models;

use App\Models\Module;
use App\Models\ModulePermission;
use App\Models\Profile;

class ModulePermissions
{
    public static function adminPermissionsForUserModule(): ModulePermission
    {
        $permission = ModulePermission::create([
            'module_name' => Module::USER,
            'profile_id' => Profile::admin()->id,
            'can_create' => true,
            'can_read' => true,
            'can_update' => true,
            'can_delete' => true,
            'can_fetch' => true,
        ]);
        return $permission;
    }

    public static function supervisorPermissionsForUserModule()
    {
        ModulePermission::create([
            'module_name' => Module::USER,
            'profile_id' => Profile::supervisor()->id,
            'can_create' => false,
            'can_read' => false,
            'can_update' => false,
            'can_delete' => false,
            'can_fetch' => false,
        ]);
    }

    public static function controllerPermissionsForUserModule()
    {
        ModulePermission::create([
            'module_name' => Module::USER,
            'profile_id' => Profile::controller()->id,
            'can_create' => false,
            'can_read' => false,
            'can_update' => false,
            'can_delete' => false,
            'can_fetch' => false,
        ]);
    }

    public static function agentPermissionsForUserModule()
    {
        ModulePermission::create([
            'module_name' => Module::USER,
            'profile_id' => Profile::agent()->id,
            'can_create' => false,
            'can_read' => false,
            'can_update' => false,
            'can_delete' => false,
            'can_fetch' => false,
        ]);
    }


    public static function adminPermissionsForOrganismModule(): ModulePermission
    {
        $permission = ModulePermission::create([
            'module_name' => Module::ORGANISM,
            'profile_id' => Profile::admin()->id,
            'can_create' => true,
            'can_read' => true,
            'can_update' => true,
            'can_delete' => true,
            'can_fetch' => true,
        ]);
        return $permission;
    }

    public static function supervisorPermissionsForOrganismModule(): ModulePermission
    {
        $permission = ModulePermission::create([
            'module_name' => Module::ORGANISM,
            'profile_id' => Profile::agent()->id,
            'can_create' => false,
            'can_read' => false,
            'can_update' => false,
            'can_delete' => false,
            'can_fetch' => false,
        ]);
        return $permission;
    }

    public static function controllerPermissionsForOrganismModule(): ModulePermission
    {
        $permission = ModulePermission::create([
            'module_name' => Module::ORGANISM,
            'profile_id' => Profile::agent()->id,
            'can_create' => false,
            'can_read' => false,
            'can_update' => false,
            'can_delete' => false,
            'can_fetch' => false,
        ]);
        return $permission;
    }

    public static function agentPermissionsForOrganismModule(): ModulePermission
    {
        $permission = ModulePermission::create([
            'module_name' => Module::ORGANISM,
            'profile_id' => Profile::agent()->id,
            'can_create' => false,
            'can_read' => false,
            'can_update' => false,
            'can_delete' => false,
            'can_fetch' => false,
        ]);
        return $permission;
    }

    public static function adminPermissionsForScannerModule(): ModulePermission
    {
        $permission = ModulePermission::create([
            'module_name' => Module::SCANNER,
            'profile_id' => Profile::admin()->id,
            'can_create' => false,
            'can_read' => true,
            'can_update' => true,
            'can_delete' => true,
            'can_fetch' => true,
        ]);
        return $permission;
    }

    public static function supervisorPermissionsForScannerModule(): ModulePermission
    {
        $permission = ModulePermission::create([
            'module_name' => Module::SCANNER,
            'profile_id' => Profile::supervisor()->id,
            'can_create' => false,
            'can_read' => true,
            'can_update' => false,
            'can_delete' => true,
            'can_fetch' => true,
        ]);
        return $permission;
    }

    public static function controllerPermissionsForScannerModule(): ModulePermission
    {
        $permission = ModulePermission::create([
            'module_name' => Module::SCANNER,
            'profile_id' => Profile::controller()->id,
            'can_create' => false,
            'can_read' => true,
            'can_update' => true,
            'can_delete' => false,
            'can_fetch' => true,
        ]);
        return $permission;
    }

    public static function agentPermissionsForScannerModule(): ModulePermission
    {
        $permission = ModulePermission::create([
            'module_name' => Module::SCANNER,
            'profile_id' => Profile::agent()->id,
            'can_create' => true,
            'can_read' => true,
            'can_update' => false,
            'can_delete' => false,
            'can_fetch' => true,
        ]);
        return $permission;
    }

    public static function adminPermissionsForProjectModule(): ModulePermission
    {
        $permission = ModulePermission::create([
            'module_name' => Module::PROJECT,
            'profile_id' => Profile::admin()->id,
            'can_create' => true,
            'can_read' => true,
            'can_update' => true,
            'can_delete' => true,
            'can_fetch' => true,
        ]);
        return $permission;
    }

    public static function supervisorPermissionsForProjectModule(): ModulePermission
    {
        $permission = ModulePermission::create([
            'module_name' => Module::PROJECT,
            'profile_id' => Profile::supervisor()->id,
            'can_create' => false,
            'can_read' => false,
            'can_update' => false,
            'can_delete' => false,
            'can_fetch' => false,
        ]);
        return $permission;
    }

    public static function controllerPermissionsForProjectModule(): ModulePermission
    {
        $permission = ModulePermission::create([
            'module_name' => Module::PROJECT,
            'profile_id' => Profile::controller()->id,
            'can_create' => false,
            'can_read' => false,
            'can_update' => false,
            'can_delete' => false,
            'can_fetch' => false,
        ]);
        return $permission;
    }

    public static function agentPermissionsForProjectModule(): ModulePermission
    {
        $permission = ModulePermission::create([
            'module_name' => Module::PROJECT,
            'profile_id' => Profile::agent()->id,
            'can_create' => false,
            'can_read' => false,
            'can_update' => false,
            'can_delete' => false,
            'can_fetch' => false,
        ]);

        return $permission;
    }
    public static function adminPermissionsForInventoryModule(): ModulePermission
    {
        $permission = ModulePermission::create([
            'module_name' => Module::INVENTORY,
            'profile_id' => Profile::admin()->id,
            'can_create' => true,
            'can_read' => true,
            'can_update' => true,
            'can_delete' => true,
            'can_fetch' => true,
        ]);

        return $permission;
    }

    public static function supervisorPermissionsForInventoryModule(): ModulePermission
    {
        $permission = ModulePermission::create([
            'module_name' => Module::INVENTORY,
            'profile_id' => Profile::supervisor()->id,
            'can_create' => false,
            'can_read' => true,
            'can_update' => true,
            'can_delete' => true,
            'can_fetch' => true,
        ]);

        return $permission;
    }

    public static function controllerPermissionsForInventoryModule(): ModulePermission
    {
        $permission = ModulePermission::create([
            'module_name' => Module::INVENTORY,
            'profile_id' => Profile::controller()->id,
            'can_create' => true,
            'can_read' => true,
            'can_update' => false,
            'can_delete' => false,
            'can_fetch' => true,
        ]);

        return $permission;
    }

    public static function agentPermissionsForInventoryModule(): ModulePermission
    {
        $permission = ModulePermission::create([
            'module_name' => Module::INVENTORY,
            'profile_id' => Profile::agent()->id,
            'can_create' => false,
            'can_read' => false,
            'can_update' => false,
            'can_delete' => false,
            'can_fetch' => false,
        ]);

        return $permission;
    }
}