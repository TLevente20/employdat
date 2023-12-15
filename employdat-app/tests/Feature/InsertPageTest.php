<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class InsertPageTest extends TestCase
{
    use RefreshDatabase;

    public function test_if_insert_page_exist_and_can_be_opened(): void
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/insert');
        $response->assertStatus(200);
    }

    public function test_insert_validation_succed_form_is_sent(): void
    {
        $user = User::factory()->create();
        $person = [
            'name' => 'John Doe',
            'email' => 'John.doe@example.com',
            'post' => 'Job Title',
        ];
        $this->assertDatabaseMissing('people', $person);
        $response = $this->actingAs($user)->post('/person', $person);
        $this->assertDatabaseHas('people', $person);

        $response->assertStatus(200);
    }

    public function test_insert_validation_fails_by_name(): void
    {
        $user = User::factory()->create();
        $person = [
            'name' => '',
            'email' => 'John.doe@example.com',
            'post' => 'Job Title',
        ];

        $this->assertDatabaseMissing('people', $person);

        $response = $this->actingAs($user)->post('/person', $person);

        $this->assertDatabaseMissing('people', $person);
        $response->assertInvalid(['name']);
        $response->assertStatus(302);

    }

    public function test_insert_validation_fails_by_email(): void
    {
        $user = User::factory()->create();
        $person = [
            'name' => 'John Doe',
            'email' => 'John.example.com',
            'post' => 'Job Title',
        ];

        $this->assertDatabaseMissing('people', $person);

        $response = $this->actingAs($user)->post('/person', $person);

        $this->assertDatabaseMissing('people', $person);
        $response->assertInvalid(['email']);
        $response->assertStatus(302);

    }

    public function test_insert_validation_fails_by_job_title(): void
    {
        $user = User::factory()->create();
        $person = [
            'name' => 'John Doe',
            'email' => 'John.example.com',
            'post' => '',
        ];

        $this->assertDatabaseMissing('people', $person);

        $response = $this->actingAs($user)->post('/person', $person);

        $this->assertDatabaseMissing('people', $person);
        $response->assertInvalid(['post']);
        $response->assertStatus(302);
    }
}
