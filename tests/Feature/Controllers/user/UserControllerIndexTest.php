<?php

namespace Tests\Feature\Controllers\user;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\Feature\BaseControllerTest;
use Tests\Feature\Models\ModulePermissions;


class UserControllerIndexTest extends BaseControllerTest
{
    use DatabaseMigrations;
    protected function setUp(): void
    {
        parent::setUp();
        $this->artisan('passport:install --force');
    }

    public function test_admin_should_see_all_users()
    {
        $data = $this->connectAsAdmin();
        $token = $data['token'];

        ModulePermissions::adminPermissionsForUserModule();
        $response = $this->get('/api/users', $this->headers($token));
        $response->assertStatus(200);
        $response->assertJsonStructure([
            "http_code",
            "success",
            "data"
        ]);
    }

    public function test_supervisor_should_not_see_all_users()
    {
        $data = $this->connectAsSupervisor();
        $token = $data['token'];
        ModulePermissions::supervisorPermissionsForUserModule();
        $response = $this->get('/api/users', $this->headers($token));
        $response->assertStatus(403);
        $response->assertJsonStructure([
            "http_code",
            "success",
            "errors"
        ]);
    }

    public function test_controller_should_not_see_all_users()
    {
        $data = $this->connectAsController();
        $token = $data['token'];
        ModulePermissions::controllerPermissionsForUserModule();
        $response = $this->get('/api/users', $this->headers($token));
        $response->assertStatus(403);
        $response->assertJsonStructure([
            "http_code",
            "success",
            "errors"
        ]);
    }

    public function test_agent_should_not_see_all_users()
    {
        $data = $this->connectAsController();
        $token = $data['token'];
        ModulePermissions::agentPermissionsForUserModule();
        $response = $this->get('/api/users', $this->headers($token));
        $response->assertStatus(403);
        $response->assertJsonStructure([
            "http_code",
            "success",
            "errors"
        ]);
    }
}