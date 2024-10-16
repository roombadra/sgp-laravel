<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Profile;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::insert([
            ['first_name' => 'john', 'last_name' => 'doe', 'email' => 'john@test.com', 'password' => Hash::make('123456'), 'profile_id' => Profile::admin()->id, 'created_at' => now(), 'updated_at' => now()],
            ['first_name' => 'james', 'last_name' => 'doe', 'email' => 'james@test.com', 'password' => Hash::make('123456'), 'profile_id' => Profile::agent()->id, 'created_at' => now(), 'updated_at' => now()],
            ['first_name' => 'jack', 'last_name' => 'doe', 'email' => 'jack@test.com', 'password' => Hash::make('123456'), 'profile_id' => Profile::supervisor()->id, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}