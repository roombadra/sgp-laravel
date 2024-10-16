<?php

namespace Database\Seeders;

use App\Models\Profile;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Profile::insert([
            ["name" => "Administrateur", "active" => true],
            ["name" => "Superviseur", "active" => true],
            ["name" => "Contrôleur", "active" => true],
            ["name" => "Agent", "active" => true]
        ]);
    }
}