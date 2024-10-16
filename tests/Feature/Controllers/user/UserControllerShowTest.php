<?php

namespace Tests\Feature\Controllers\user;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\Feature\BaseControllerTest;
use Tests\Feature\Models\ModulePermissions;


class UserControllerShowTest extends BaseControllerTest
{
    use DatabaseMigrations;
    protected function setUp(): void
    {
        parent::setUp();
        $this->artisan('passport:install --force');
    }

    public function test_admin_should_see_user()
    {
        $data = $this->connectAsAdmin();
        $token = $data['token'];

        ModulePermissions::adminPermissionsForUserModule();

        $user = $this->addUserAsController();

        $response = $this->get('/api/users/' . $user->id, $this->headers($token));
        $response->assertStatus(200);
        $response->assertJsonStructure([
            "http_code",
            "success",
            "data"
        ]);
    }

    public function test_supervisor_should_not_see_user()
    {
        $data = $this->connectAsSupervisor();
        $token = $data['token'];
        $user = $this->addUserAsController();
        ModulePermissions::supervisorPermissionsForUserModule();
        $response = $this->get('/api/users/' . $user->id, $this->headers($token));
        $response->assertStatus(403);
        $response->assertJsonStructure([
            "http_code",
            "success",
            "errors"
        ]);
    }

    public function test_controller_should_not_see_user()
    {
        $data = $this->connectAsController();
        $token = $data['token'];
        $user = $this->addUserAsController();
        ModulePermissions::controllerPermissionsForUserModule();
        $response = $this->get('/api/users/' . $user->id, $this->headers($token));
        $response->assertStatus(403);
        $response->assertJsonStructure([
            "http_code",
            "success",
            "errors"
        ]);
    }

    public function test_agent_should_not_see_user()
    {
        $data = $this->connectAsController();
        $token = $data['token'];
        $user = $this->addUserAsController();
        ModulePermissions::agentPermissionsForUserModule();
        $response = $this->get('/api/users/' . $user->id, $this->headers($token));
        $response->assertStatus(403);
        $response->assertJsonStructure([
            "http_code",
            "success",
            "errors"
        ]);
    }

}