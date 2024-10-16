<?php

namespace Tests\Feature\Controllers\Inventory;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\Feature\BaseControllerTest;
use Tests\Feature\Models\ModulePermissions;

class InventoryControllerUpdateTest extends BaseControllerTest
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

        ModulePermissions::adminPermissionsForInventoryModule();

        $inventory = $this->generateInventory();
        $inventory->name = 'this is a new name test';
        $inventory->projet_id = $this->generateProjet()->id;

        $response = $this->put(
            '/api/inventories/' . $inventory->id, $inventory->toArray(),
            $this->headers($token)
        );
        $response->assertStatus(200);
        $response->assertJsonStructure([
            "http_code",
            "success",
            "data"
        ]);
    }

    public function test_test_should_pass_for_supervisor()
    {
        $data = $this->connectAsSupervisor();
        $token = $data['token'];
        $this->assertNotNull($token);

        ModulePermissions::supervisorPermissionsForInventoryModule();

        $inventory = $this->generateInventory();
        $inventory->name = 'this is a new name test';
        $inventory->projet_id = $this->generateProjet()->id;

        $response = $this->put(
            '/api/inventories/' . $inventory->id,
            $inventory->toArray(),
            $this->headers($token)
        );
        $response->assertStatus(200);
        $response->assertJsonStructure([
            "http_code",
            "success",
            "data"
        ]);
    }

    public function test_test_should_not_pass_for_controller()
    {
        $data = $this->connectAsController();
        $token = $data['token'];
        $this->assertNotNull($token);

        ModulePermissions::controllerPermissionsForInventoryModule();

        $inventory = $this->generateInventory();
        $inventory->name = 'this is a new name test';
        $inventory->projet_id = $this->generateProjet()->id;

        $response = $this->put(
            '/api/inventories/' . $inventory->id,
            $inventory->toArray(),
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

        ModulePermissions::agentPermissionsForInventoryModule();

        $inventory = $this->generateInventory();
        $inventory->name = 'this is a new name test';
        $inventory->projet_id = $this->generateProjet()->id;

        $response = $this->put(
            '/api/inventories/' . $inventory->id,
            $inventory->toArray(),
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