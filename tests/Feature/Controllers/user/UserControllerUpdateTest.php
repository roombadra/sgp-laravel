<?php

namespace Tests\Feature\Controllers\user;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\Feature\BaseControllerTest;
use Tests\Feature\Models\ModulePermissions;

class UserControllerUpdateTest extends BaseControllerTest
{
    use DatabaseMigrations;
    protected function setUp(): void
    {
        parent::setUp();
        $this->artisan('passport:install --force');
    }

    public function test_test_admin_should_update_user()
    {
        $data = $this->connectAsAdmin();
        $token = $data['token'];

        ModulePermissions::adminPermissionsForUserModule();

        $user = $this->addUserAsController();
        $user->email = "imcontroller@gmail.com";
        $user->password = "9876543210";
        $response = $this->put('/api/users/' . $user->id, $user->toArray(), $this->headers($token));
        $response->assertStatus(200);
        $response->assertJsonStructure([
            "http_code",
            "success",
            "data"
        ]);
        //dd($response['data']);
    }

    public function test_test_supervisor_should_not_update_user()
    {
        $data = $this->connectAsSupervisor();
        $token = $data['token'];

        ModulePermissions::supervisorPermissionsForUserModule();

        $user = $this->addUserAsAdmin();
        $user->email = "imadmin@gmail.com";
        $user->password = "9876543210";
        $response = $this->put('/api/users/' . $user->id, $user->toArray(), $this->headers($token));
        $response->assertStatus(403);
        $response->assertJsonStructure([
            "http_code",
            "success",
            "errors"
        ]);
    }

    public function test_test_controller_should_not_update_user()
    {
        $data = $this->connectAsController();
        $token = $data['token'];

        ModulePermissions::controllerPermissionsForUserModule();

        $user = $this->addUserAsAgent();
        $user->email = "imagent@gmail.com";
        $user->password = "9876543210";
        $response = $this->put('/api/users/' . $user->id, $user->toArray(), $this->headers($token));
        $response->assertStatus(403);
        $response->assertJsonStructure([
            "http_code",
            "success",
            "errors"
        ]);
    }

    public function test_test_agent_should_not_update_user()
    {
        $data = $this->connectAsAgent();
        $token = $data['token'];

        ModulePermissions::agentPermissionsForUserModule();

        $user = $this->addUserAsSupervisor();
        $user->email = "imsupervisor@gmail.com";
        $user->password = "9876543210";
        $response = $this->put('/api/users/' . $user->id, $user->toArray(), $this->headers($token));
        $response->assertStatus(403);
        $response->assertJsonStructure([
            "http_code",
            "success",
            "errors"
        ]);
    }
}