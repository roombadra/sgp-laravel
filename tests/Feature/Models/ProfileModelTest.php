<?php

namespace Tests\Feature\Models;

use App\Models\Profile;
use Tests\Feature\BaseControllerTest;

class ProfileModelTest extends BaseControllerTest
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->artisan('passport:install --force');
    }


    /** @test */
    public function profile_should_be_empty()
    {
        // $this->assertCount(1, [1], 'Should have 1');
        $response = $this->initialiseProfiles();
        $this->assertEmpty($response, 'Profile list should be empty');
        $this->assertTrue(count($response) === 0, 'Profile list should');
    }

    public function test_testCreateProfileAdmin()
    {
        $response = Profile::admin();
        $this->assertNotNull($response);
        $this->assertNotEmpty($response);
        return $response;
    }

    public function test_testCreateProfileSupervisor()
    {
        $response = Profile::supervisor();
        $this->assertNotNull($response);
        $this->assertNotEmpty($response);
        return $response;
    }

    public function test_testCreateProfileController()
    {
        $response = Profile::controller();
        $this->assertNotNull($response);
        $this->assertNotEmpty($response);
        return $response;
    }


    public function test_testCreateProfileAgent()
    {
        $response = Profile::Agent();
        $this->assertNotNull($response);
        $this->assertNotEmpty($response);
        return $response;
    }

    public function test_profile_should_not_be_empty()
    {
        $response = $this->initialiseProfiles();
        $this->assertTrue($response > 0, 'Profile list should not be empty');
    }



}