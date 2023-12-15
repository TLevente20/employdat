<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    use RefreshDatabase;
    public function test_new_user_can_be_created(): void
    {
        $user = User::factory()->create();
        $newUser = [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123'
        ];
        $response = $this->actingAs($user)->post('/profile',$newUser);
        $this->assertDatabaseCount('users',2);
        $response->assertStatus(200);
    }
    public function test_new_user_validation_fails_name_is_empty(): void
    {
        $user = User::factory()->create();
        $newUser = [
            'name' => '',
            'email' => 'john@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123'
        ];
        $response = $this->actingAs($user)->post('/profile',$newUser);
        $response->assertInvalid(['name']);
        $this->assertDatabaseCount('users',1);
        $response->assertStatus(302);
    }

    public function test_new_user_validation_fails_email_is_empty(): void
    {
        $user = User::factory()->create();
        $newUser = [
            'name' => 'John Doe',
            'email' => '',
            'password' => 'password123',
            'password_confirmation' => 'password123'
        ];
        $response = $this->actingAs($user)->post('/profile',$newUser);
        $response->assertInvalid(['email']);
        $this->assertDatabaseCount('users',1);
        $response->assertStatus(302);
    }

    public function test_new_user_validation_fails_email_is_taken(): void
    {
        $user = User::factory()->create();
        $newUser = [
            'name' => 'John Doe',
            'email' => $user->email,
            'password' => 'password123',
            'password_confirmation' => 'password123'
        ];
        $response = $this->actingAs($user)->post('/profile',$newUser);
        $response->assertInvalid(['email']);
        $this->assertDatabaseCount('users',1);
        $response->assertStatus(302);
    }
    public function test_new_user_validation_password_is_empty(): void
    {
        $user = User::factory()->create();
        $newUser = [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => '',
            'password_confirmation' => ''
        ];
        $response = $this->actingAs($user)->post('/profile',$newUser);
        $response->assertInvalid(['password']);
        $this->assertDatabaseCount('users',1);
        $response->assertStatus(302);
    }
    public function test_new_user_validation_passwords_doesnt_mathch_confirm(): void
    {
        $user = User::factory()->create();
        $newUser = [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password456'
        ];
        $response = $this->actingAs($user)->post('/profile',$newUser);
        $response->assertInvalid(['password']);
        $this->assertDatabaseCount('users',1);
        $response->assertStatus(302);
    }
    public function test_new_user_validation_password_is_too_short(): void
    {
        $user = User::factory()->create();
        $newUser = [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => 'pass3',
            'password_confirmation' => 'pass'
        ];
        $response = $this->actingAs($user)->post('/profile',$newUser);
        $response->assertInvalid(['password']);
        $this->assertDatabaseCount('users',1);
        $response->assertStatus(302);
    }
}
