<?php

namespace Tests\Feature;


use App\Models\Inventory;
use App\Models\Organism;
use App\Models\Profile;
use App\Models\Projet;
use App\Models\Scanner;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;

use Tests\TestCase;

class BaseControllerTest extends TestCase
{
    use DatabaseMigrations;


    public function initialiseProfiles()
    {
        return Profile::all()->toArray();
    }

    public function headers($token)
    {
        return [
            'Authorization' => 'Bearer ' . $token,
            'Accept' => 'application/json',
        ];
    }
    public function generateUser(Profile $profile)
    {
        $data = [
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'email' => fake()->email(),
            'password' => bcrypt('123456789'),
            'profile_id' => $profile->id,
        ];

        return User::create($data);
    }


    public function addUsers()
    {
        $this->generateUser(Profile::admin());
        $this->generateUser(Profile::supervisor());
        $this->generateUser(Profile::controller());
        $this->generateUser(Profile::agent());
    }

    public function generateOrganisms(): Organism
    {
        $data = [
            'name' => fake()->name(),
            'active' => fake()->boolean(),
        ];
        return Organism::create($data);
    }

    public function generateScanner(): Scanner
    {
        $data = [
            'marque' => fake()->name(),
            'model' => fake()->name(),
            'serial_number' => fake()->name(),
            'active' => fake()->boolean(),
        ];
        return Scanner::create($data);
    }

    public function generateInventory(): Inventory
    {
        $data = [
            'name' => fake()->name(),
            'projet_id' => $this->generateProjet()->id,
            'type' => fake()->randomElement(['material', 'consumable']),
            'quantity' => fake()->numberBetween(1, 100),
            'location' => fake()->address(),
        ];
        return Inventory::create($data);
    }

    public function generateProjet(): Projet
    {
        $data = [
            'name' => fake()->name(),
            'organism_id' => $this->generateOrganisms()->id,
            'active' => fake()->boolean(),
        ];
        return Projet::create($data);
    }

    public function addUserAsAdmin()
    {
        return $this->generateUser(Profile::admin());

    }

    public function addUserAsSupervisor()
    {
        return $this->generateUser(Profile::supervisor());
    }

    public function addUserAsController()
    {
        return $this->generateUser(Profile::controller());
    }

    public function addUserAsAgent()
    {
        return $this->generateUser(Profile::agent());
    }

    public function count_users()
    {
        return User::all()->count();
    }

    public function test_user_should_not_be_empty()
    {
        $this->addUsers();
        $this->assertTrue($this->count_users() > 0, 'User list should not be empty');
    }

    public function connectAsAdmin()
    {
        $user = $this->addUserAsAdmin();
        $response = $this->post('/api/login', [
            'email' => $user->email,
            'password' => '123456789',
        ], ["Accept" => "application/json"]);

        $response->assertStatus(200);
        $response->assertJsonStructure([
            "http_code",
            "success",
            "data"
        ]);

        // Lire le contenu du fichier de log
        $file = file_get_contents(storage_path('logs/auth.log'));

        // Vérification si le log a été enregistré avec succès
        $this->assertTrue(strpos($file, 'Utilisateur connecté') !== false);

        // Vérification si le message de log contient les informations attendues
        $this->assertStringContainsString('Utilisateur connecté', $file);
        $this->assertStringContainsString('INFO', $file);
        $this->assertStringContainsString($user->email, $file);

        $data = $response->json();

        $this->assertArrayHasKey('token', $data['data']);
        $this->assertArrayHasKey('user', $data['data']);

        return $data['data'];
    }

    public function connectAsSupervisor()
    {
        $user = $this->addUserAsSupervisor();
        $response = $this->post('/api/login', [
            'email' => $user->email,
            'password' => '123456789',
        ], ["Accept" => "application/json"]);

        $response->assertStatus(200);
        $response->assertJsonStructure([
            "http_code",
            "success",
            "data"
        ]);
        $data = $response->json();

        $this->assertArrayHasKey('token', $data['data']);
        $this->assertArrayHasKey('user', $data['data']);

        return $data['data'];
    }

    public function connectAsController()
    {
        $user = $this->addUserAsController();
        $response = $this->post('/api/login', [
            'email' => $user->email,
            'password' => '123456789',
        ], ["Accept" => "application/json"]);
        $response->assertStatus(200);
        $response->assertJsonStructure([
            "http_code",
            "success",
            "data"
        ]);
        $data = $response->json();

        $this->assertArrayHasKey('token', $data['data']);
        $this->assertArrayHasKey('user', $data['data']);

        return $data['data'];
    }

    public function connectAsAgent()
    {
        $user = $this->addUserAsAgent();
        $response = $this->post('/api/login', [
            'email' => $user->email,
            'password' => '123456789',
        ], ["Accept" => "application/json"]);
        $response->assertStatus(200);
        $response->assertJsonStructure([
            "http_code",
            "success",
            "data"
        ]);
        $data = $response->json();

        $this->assertArrayHasKey('token', $data['data']);
        $this->assertArrayHasKey('user', $data['data']);

        return $data['data'];
    }


}