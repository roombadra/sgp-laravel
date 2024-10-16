<?php

namespace Database\Seeders;

use App\Models\Module;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Module::insert([
            ['name' => 'Utilisateur', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Organisme', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Projet', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Inventaire', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Activité', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Rapport', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Scanner', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}