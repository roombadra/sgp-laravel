<?php

namespace Tests\Feature\Controllers\user;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\Feature\BaseControllerTest;
use Tests\Feature\Models\ModulePermissions;

class UserControllerDeleteTest extends BaseControllerTest
{
    use DatabaseMigrations;
    protected function setUp(): void
    {
        parent::setUp();
        $this->artisan('passport:install --force');
    }

    public function test_test_admin_can_delete_user()
    {
        $data = $this->connectAsAdmin();
        $token = $data['token'];

        ModulePermissions::adminPermissionsForUserModule();

        $user = $this->addUserAsAgent();

        $response = $this->delete('/api/users/' . $user->id, [], $this->headers($token));
        $response->assertStatus(204);
    }

    public function test_test_supervisor_can_not_delete_user()
    {
        $data = $this->connectAsSupervisor();
        $token = $data['token'];

        ModulePermissions::supervisorPermissionsForUserModule();

        $user = $this->addUserAsController();

        $response = $this->delete('/api/users/' . $user->id, [], $this->headers($token));
        $response->assertStatus(403);
    }

    public function test_test_controller_can_not_delete_user()
    {
        $data = $this->connectAsController();
        $token = $data['token'];

        ModulePermissions::controllerPermissionsForUserModule();

        $user = $this->addUserAsAdmin();

        $response = $this->delete('/api/users/' . $user->id, [], $this->headers($token));
        $response->assertStatus(403);
    }

    public function test_test_agent_can_not_delete_user()
    {
        $data = $this->connectAsAgent();
        $token = $data['token'];

        ModulePermissions::agentPermissionsForUserModule();

        $user = $this->addUserAsAgent();

        $response = $this->delete('/api/users/' . $user->id, [], $this->headers($token));
        $response->assertStatus(403);
    }
}