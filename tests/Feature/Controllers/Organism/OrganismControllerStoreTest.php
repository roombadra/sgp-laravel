<?php

namespace Tests\Feature\Controllers\Organism;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\Feature\BaseControllerTest;
use Tests\Feature\Models\ModulePermissions;


class OrganismControllerStoreTest extends BaseControllerTest
{
    use DatabaseMigrations;

    protected function setUp(): void
    {
        parent::setUp();
        $this->artisan('passport:install --force');
    }

    public function test_test_should_pass_for_admin()
    {
        $data = $this->connectAsAdmin();
        $token = $data['token'];
        $this->assertNotNull($token);

        ModulePermissions::adminPermissionsForOrganismModule();

        $response = $this->post(
            '/api/organisms',
            [
                "name" => "CNRS",
                "active" => true,
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

    public function test_test_should_not_pass_supervisor()
    {
        $data = $this->connectAsSupervisor();
        $token = $data['token'];
        $this->assertNotNull($token);

        ModulePermissions::supervisorPermissionsForOrganismModule();

        $response = $this->post(
            '/api/organisms',
            [
                "name" => "CNOPS",
                "active" => true,
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

    public function test_test_should_not_pass_for_controller()
    {
        $data = $this->connectAsController();
        $token = $data['token'];
        $this->assertNotNull($token);

        ModulePermissions::controllerPermissionsForOrganismModule();

        $response = $this->post(
            '/api/organisms',
            [
                "name" => "CNOPS",
                "active" => true,
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

    public function test_test_should_not_pass_for_agent()
    {
        $data = $this->connectAsAgent();
        $token = $data['token'];
        $this->assertNotNull($token);

        ModulePermissions::agentPermissionsForOrganismModule();

        $response = $this->post(
            '/api/organisms',
            [
                "name" => "CNOPS",
                "active" => true,
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