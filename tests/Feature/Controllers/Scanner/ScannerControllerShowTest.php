<?php

namespace Tests\Feature\Controllers\Scanner;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Feature\BaseControllerTest;
use Tests\Feature\Models\ModulePermissions;
use Tests\TestCase;

class ScannerControllerShowTest extends BaseControllerTest
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

        $response = $this->get('/api/scanners/' . $scanner->id, $this->headers($token));
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

        ModulePermissions::supervisorPermissionsForScannerModule();

        $scanner = $this->generateScanner();

        $response = $this->get('/api/scanners/' . $scanner->id, $this->headers($token));
        $response->assertStatus(200);
        $response->assertJsonStructure([
            "http_code",
            "success",
            "data"
        ]);
    }

    public function test_test_should_passs_for_controller()
    {
        $data = $this->connectAsController();
        $token = $data['token'];
        $this->assertNotNull($token);

        ModulePermissions::controllerPermissionsForScannerModule();

        $scanner = $this->generateScanner();

        $response = $this->get('/api/scanners/' . $scanner->id, $this->headers($token));
        $response->assertStatus(200);
        $response->assertJsonStructure([
            "http_code",
            "success",
            "data"
        ]);
    }

    public function test_test_should_pass_for_agent()
    {
        $data = $this->connectAsAgent();
        $token = $data['token'];
        $this->assertNotNull($token);

        ModulePermissions::agentPermissionsForScannerModule();

        $scanner = $this->generateScanner();

        $response = $this->get('/api/scanners/' . $scanner->id, $this->headers($token));
        $response->assertStatus(200);
        $response->assertJsonStructure([
            "http_code",
            "success",
            "data"
        ]);
    }
}