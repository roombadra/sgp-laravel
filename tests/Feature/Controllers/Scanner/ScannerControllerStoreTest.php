<?php

namespace Tests\Feature\Controllers\Scanner;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\Feature\BaseControllerTest;
use Tests\Feature\Models\ModulePermissions;


class ScannerControllerStoreTest extends BaseControllerTest
{
    use DatabaseMigrations;

    protected function setUp(): void
    {
        parent::setUp();
        $this->artisan('passport:install --force');
    }

    public function test_test_should_not_pass_for_admin()
    {
        $data = $this->connectAsAdmin();
        $token = $data['token'];
        $this->assertNotNull($token);

        ModulePermissions::adminPermissionsForScannerModule();

        $response = $this->post(
            '/api/scanners',
            [
                'marque' => 'DELL',
                'model' => 'DELL-651',
                'serial_number' => 'DELL-358-742-161',
                'active' => true,

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

    public function test_test_should_not_pass_for_supervisor()
    {
        $data = $this->connectAsSupervisor();
        $token = $data['token'];
        $this->assertNotNull($token);

        ModulePermissions::supervisorPermissionsForScannerModule();

        $response = $this->post(
            '/api/scanners',
            [
                'marque' => 'HP',
                'model' => 'HP-004',
                'serial_number' => 'HP-685-124-074',
                'active' => false,

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

        ModulePermissions::controllerPermissionsForScannerModule();

        $response = $this->post(
            '/api/scanners',
            [
                'marque' => 'HP',
                'model' => 'HP-347',
                'serial_number' => 'HP-347-450-991',
                'active' => false,

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

    public function test_test_should_pass_for_agent()
    {
        $data = $this->connectAsAgent();
        $token = $data['token'];
        $this->assertNotNull($token);

        ModulePermissions::agentPermissionsForScannerModule();

        $response = $this->post(
            '/api/scanners',
            [
                'marque' => 'LENOVO',
                'model' => 'LENOVO-568',
                'serial_number' => 'LENOVO-568-010-652',
                'active' => true,

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
}