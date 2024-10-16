<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Profile extends Model
{
    use HasFactory;

    public const ADMIN = "Administrateur";
    public const SUPERVISOR = "Superviseur";
    public const CONTROLLER = "Contrôleur";
    public const AGENT = "Agent";




    public const PROFILES = [
        self::ADMIN,

        self::SUPERVISOR,

        self::CONTROLLER,
        self::AGENT
    ];

    protected $fillable = [
        "name"
    ];
    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function scopeAdmin($query)
    {
        $admin = $query->where('name', self::ADMIN)->first();

        if (!$admin) {
            return Profile::create(['name' => self::ADMIN]);
        }

        return $admin;
    }

    public function scopeController($query)
    {
        $controller = $query->where('name', self::CONTROLLER)->first();

        if (!$controller) {
            return Profile::create(['name' => self::CONTROLLER]);
        }

        return $controller;
    }

    public function scopeSupervisor($query)
    {
        $supervisor = $query->where('name', self::SUPERVISOR)->first();

        if (!$supervisor) {
            return Profile::create(['name' => self::SUPERVISOR]);
        }

        return $supervisor;
    }

    public function scopeAgent($query)
    {
        $agent = $query->where('name', self::AGENT)->first();

        if (!$agent) {
            return Profile::create(['name' => self::AGENT]);
        }

        return $agent;
    }
}