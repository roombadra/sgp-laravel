<?php

namespace Tests\Feature\Controllers;

use Illuminate\Database\DatabaseManager;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Log;
use Tests\Feature\BaseControllerTest;
use Tests\TestCase;

class LoginControllerTest extends BaseControllerTest
{
    use DatabaseMigrations;
    protected function setUp(): void
    {
        parent::setUp();

        $this->artisan('passport:install --force');
    }

    public function test_login_invalid_without_data()
    {
        $response = $this->postJson('api/login', [
            'email' => '',
            'password' => '',
        ]);
        $response->assertStatus(400);

        $response->assertJsonValidationErrors([
            'email' => 'The email field is required.',
            'password' => 'The password field is required.',
        ]);
    }

    public function test_login_should_be_invalid()
    {
        $response = $this->postJson('api/login', [
            'email' => 'admin@gmail.com',
            'password' => '123456789',
        ]);
        $response->assertStatus(422);

        $response->assertJsonStructure([
            "http_code",
            "success",
            "errors"
        ]);

        // Lire le contenu du fichier de log
        $file = file_get_contents(storage_path('logs/auth.log'));

        // Vérification si le log a été enregistré avec succès
        $this->assertTrue(strpos($file, 'Tentative de connexion échouée') !== false);
        // Vérification si le message de log contient les informations attendues
        $this->assertStringContainsString('Tentative de connexion échouée', $file);
        $this->assertStringContainsString('WARNING', $file);
        $this->assertStringContainsString('admin@gmail.com', $file);

    }

    public function test_login_should_be_valid()
    {
        return $this->connectAsAgent();
    }

}