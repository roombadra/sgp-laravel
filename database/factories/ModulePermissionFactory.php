<?php

namespace Database\Factories;

use App\Models\Module;
use App\Models\Profile;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ModulePermission>
 */
class ModulePermissionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "profile_id" => Profile::all()->random(),
            "module_name" => fake()->randomElement(["UTILISATEURS", "ORGANISMES", "PROJETS", "INVENTAIRES", "SCANNERS"]),
            "active" => fake()->boolean(),
            "can_create" => fake()->boolean(),
            "can_read" => fake()->boolean(),
            "can_update" => fake()->boolean(),
            "can_delete" => fake()->boolean(),
            "can_fetch" => fake()->boolean(),
        ];
    }
}