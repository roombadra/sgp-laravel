<?php

namespace Tests\Feature\Controllers\Organism;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\Feature\BaseControllerTest;
use Tests\Feature\Models\ModulePermissions;

class OrganismControllerUpdateTest extends BaseControllerTest
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

        $organism = $this->generateOrganisms();

        $organism->name = 'NSIP';

        $response = $this->put('/api/organisms/' . $organism->id, $organism->toArray(), $this->headers($token));
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

        ModulePermissions::supervisorPermissionsForOrganismModule();

        $organism = $this->generateOrganisms();

        $organism->name = 'MQZ';

        $response = $this->put('/api/organisms/' . $organism->id, $organism->toArray(), $this->headers($token));
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

        $organism = $this->generateOrganisms();

        $organism->name = 'LDDNI';
        $organism->active = false;

        $response = $this->put('/api/organisms/' . $organism->id, $organism->toArray(), $this->headers($token));
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

        $organism = $this->generateOrganisms();

        $organism->name = 'BREE';
        $organism->active = false;

        $response = $this->put('/api/organisms/' . $organism->id, $organism->toArray(), $this->headers($token));
        $response->assertStatus(403);
        $response->assertJsonStructure([
            "http_code",
            "success",
            "errors"
        ]);
    }
}