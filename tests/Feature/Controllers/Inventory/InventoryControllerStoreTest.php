<?php

namespace Tests\Feature\Controllers\Inventory;


use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\Feature\BaseControllerTest;
use Tests\Feature\Models\ModulePermissions;

class InventoryControllerStoreTest extends BaseControllerTest
{

    use DatabaseMigrations;
    protected function setUp(): void
    {
        parent::setUp();
        $this->artisan('passport:install --force');
    }

    public function test_test_should_pass_admin()
    {
        $data = $this->connectAsAdmin();
        $token = $data['token'];
        $this->assertNotNull($token);

        ModulePermissions::adminPermissionsForInventoryModule();

        $response = $this->post(
            '/api/inventories',
            [
                'name' => 'this is a test',
                'projet_id' => $this->generateProjet()->id,
                'type' => 'this is a type test',
                'quantity' => 'this is a quantity test',
                'location' => 'this is a location test',
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

    public function test_test_should_not_pass_for_supervisor()
    {
        $data = $this->connectAsAgent();
        $token = $data['token'];
        $this->assertNotNull($token);

        ModulePermissions::agentPermissionsForInventoryModule();

        $response = $this->post(
            '/api/inventories',
            [
                'name' => 'this is a test map',
                'projet_id' => $this->generateProjet()->id,
                'type' => 'this is a type test',
                'quantity' => 'this is a quantity test map',
                'location' => 'this is a location test map',
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

    public function test_test_should_pass_for_controller()
    {
        $data = $this->connectAsController();
        $token = $data['token'];
        $this->assertNotNull($token);

        ModulePermissions::controllerPermissionsForInventoryModule();

        $response = $this->post(
            '/api/inventories',
            [
                'name' => 'this is a test controller',
                'projet_id' => $this->generateProjet()->id,
                'type' => 'this is a type test controller',
                'quantity' => 'this is a quantity test controller',
                'location' => 'this is a location test controller',
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

    public function test_test_should_not_pass_for_agent()
    {
        $data = $this->connectAsAgent();
        $token = $data['token'];
        $this->assertNotNull($token);

        ModulePermissions::agentPermissionsForInventoryModule();

        $response = $this->post(
            '/api/inventories',
            [
                'name' => 'this is a test agent',
                'projet_id' => $this->generateProjet()->id,
                'type' => 'this is a type test agent',
                'quantity' => 'this is a quantity test agent',
                'location' => 'this is a location test agent',
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