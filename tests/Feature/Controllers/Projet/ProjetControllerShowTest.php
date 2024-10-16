<?php

namespace Tests\Feature\Controllers\Projet;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\Feature\BaseControllerTest;
use Tests\Feature\Models\ModulePermissions;


class ProjetControllerShowTest extends BaseControllerTest
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

        ModulePermissions::adminPermissionsForProjectModule();

        $project = $this->generateProjet();

        $response = $this->get('/api/projets/' . $project->id, $this->headers($token));
        $response->assertStatus(200);
        $response->assertJsonStructure([
            "http_code",
            "success",
            "data"
        ]);
    }

    public function test_test_should_not_pass_for_supervisor()
    {
        $data = $this->connectAsSupervisor();
        $token = $data['token'];
        $this->assertNotNull($token);

        ModulePermissions::supervisorPermissionsForProjectModule();

        $project = $this->generateProjet();

        $response = $this->get('/api/projets/' . $project->id, $this->headers($token));
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

        ModulePermissions::controllerPermissionsForProjectModule();

        $project = $this->generateProjet();

        $response = $this->get('/api/projets/' . $project->id, $this->headers($token));
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

        ModulePermissions::agentPermissionsForProjectModule();

        $project = $this->generateProjet();

        $response = $this->get('/api/projets/' . $project->id, $this->headers($token));
        $response->assertStatus(403);
        $response->assertJsonStructure([
            "http_code",
            "success",
            "errors"
        ]);
    }
}