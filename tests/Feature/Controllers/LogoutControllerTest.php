<?php

namespace Tests\Feature\Controllers;

use Tests\TestCase;
use Tests\Feature\BaseControllerTest;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use League\OAuth2\Server\ResponseTypes\BearerTokenResponse;

class LogoutControllerTest extends BaseControllerTest
{
    use DatabaseMigrations;
    protected function setUp(): void
    {
        parent::setUp();

        $this->artisan('passport:install --force');
    }

    public function test_logout_should_be_error_without_token()
    {
        $response = $this->postJson(
            'api/logout',
        );
        $response->assertStatus(401);
    }

    public function test_logout_should_be_success()
    {

        $data = $this->connectAsAdmin();
        $token = $data['token'];
        $response = $this->post('/api/logout', [], $this->headers($token));
        $response->assertStatus(200);
    }
}