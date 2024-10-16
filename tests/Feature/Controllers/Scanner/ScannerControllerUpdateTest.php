<?php

namespace Tests\Feature\Controllers\Scanner;


use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\Feature\BaseControllerTest;
use Tests\Feature\Models\ModulePermissions;

class ScannerControllerUpdateTest extends BaseControllerTest
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

        ModulePermissions::adminPermissionsForScannerModule();

        $scanner = $this->generateScanner();
        $scanner->name = 'ACER';
        $scanner->model = 'ACER-367';
        $scanner->active = false;

        $response = $this->put('/api/scanners/' . $scanner->id, $scanner->toArray(), $this->headers($token));
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

        ModulePermissions::supervisorPermissionsForScannerModule();

        $scanner = $this->generateScanner();
        $scanner->name = 'HP';
        $scanner->model = 'HP-741';
        $scanner->active = false;

        $response = $this->put('/api/scanners/' . $scanner->id, $scanner->toArray(), $this->headers($token));
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

        ModulePermissions::controllerPermissionsForScannerModule();

        $scanner = $this->generateScanner();
        $scanner->name = 'DELL';
        $scanner->model = 'DELL-003';
        $scanner->active = true;

        $response = $this->put('/api/scanners/' . $scanner->id, $scanner->toArray(), $this->headers($token));
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

        ModulePermissions::agentPermissionsForScannerModule();

        $scanner = $this->generateScanner();
        $scanner->name = 'HP';
        $scanner->model = 'HP-107';
        $scanner->active = true;

        $response = $this->put('/api/scanners/' . $scanner->id, $scanner->toArray(), $this->headers($token));
        $response->assertStatus(403);
        $response->assertJsonStructure([
            "http_code",
            "success",
            "errors"
        ]);
    }
}