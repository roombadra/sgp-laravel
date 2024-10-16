<?php

namespace App\Models;

use App\Models\Module;
use App\Models\Profile;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ModulePermission extends Model
{
    use HasFactory;
    protected $fillable = [
        "module_name",
        "profile_id",
        "can_create",
        "can_read",
        "can_update",
        "can_delete",
        "can_fetch",
    ];

    protected $cast = [
        "profile_id" => "integer",
        "module_name" => "string",
    ];

    public function scopeForModule($query, string $module_name)
    {
        return $query->where("module_name", $module_name);
    }

    public function scopeForProfile($query, int $profile_id)
    {
        return $query->where("profile_id", $profile_id);
    }
}