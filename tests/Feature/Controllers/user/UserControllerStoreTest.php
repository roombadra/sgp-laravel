<?php

namespace Tests\Feature\Controllers\user;

use App\Models\Profile;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\Feature\BaseControllerTest;
use Tests\Feature\Models\ModulePermissions;




class UserControllerStoreTest extends BaseControllerTest
{
    use DatabaseMigrations;
    protected function setUp(): void
    {
        parent::setUp();
        $this->artisan('passport:install --force');
    }

    public function test_admin_should_create_a_user()
    {
        $data = $this->connectAsAdmin();
        $token = $data['token'];

        ModulePermissions::adminPermissionsForUserModule();

        $response = $this->post(
            '/api/users',
            [
                'first_name' => fake()->firstName(),
                'last_name' => fake()->lastName(),
                'email' => fake()->email(),
                'password' => bcrypt('123456789'),
                'profile_id' => Profile::agent()->id,
            ],
            $this->headers($token)
        );
        $response->assertStatus(200);
        $response->assertJsonStructure([
            "http_code",
            "success",
            "data"
        ]);
    }

    public function test_superviseur_can_not_create_user()
    {
        $data = $this->connectAsSupervisor();
        $token = $data['token'];

        ModulePermissions::supervisorPermissionsForUserModule();

        $response = $this->post(
            '/api/users',
            [
                'first_name' => fake()->firstName(),
                'last_name' => fake()->lastName(),
                'email' => fake()->email(),
                'password' => bcrypt('123456789'),
                'profile_id' => Profile::admin()->id,
            ],
            $this->headers($token)
        );
        $response->assertStatus(403);
        $response->assertJsonStructure([
            "http_code",
            "success",
            "errors"
        ]);
    }

    public function test_controller_can_not_create_user()
    {
        $data = $this->connectAsController();
        $token = $data['token'];

        ModulePermissions::controllerPermissionsForUserModule();

        $response = $this->post(
            '/api/users',
            [
                'first_name' => fake()->firstName(),
                'last_name' => fake()->lastName(),
                'email' => fake()->email(),
                'password' => bcrypt('123456789'),
                'profile_id' => Profile::admin()->id,
            ],
            $this->headers($token)
        );
        $response->assertStatus(403);
        $response->assertJsonStructure([
            "http_code",
            "success",
            "errors"
        ]);
    }

    public function test_agent_can_not_create_user()
    {
        $data = $this->connectAsAgent();
        $token = $data['token'];

        ModulePermissions::supervisorPermissionsForUserModule();

        $response = $this->post(
            '/api/users',
            [
                'first_name' => fake()->firstName(),
                'last_name' => fake()->lastName(),
                'email' => fake()->email(),
                'password' => bcrypt('123456789'),
                'profile_id' => Profile::admin()->id,
            ],
            $this->headers($token)
        );
        $response->assertStatus(403);
        $response->assertJsonStructure([
            "http_code",
            "success",
            "errors"
        ]);
    }

}