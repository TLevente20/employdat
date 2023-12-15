<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EditProfileTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_profile_can_be_edited():void
    {
        $user = User::factory()->create();
        $editedUser = [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => $user->password
        ];
        $response = $this->actingAs($user)->put('/profile/'.$user->id, $editedUser);
        $this->assertDatabaseHas('users',$editedUser);
        $this->assertDatabaseCount('users',1);
        $response->assertStatus(200);
    }
    public function test_profile_edit_validation_fails_name_is_empty():void
    {
        $user = User::factory()->create();
        $editedUser = [
            'name' => '',
            'email' => 'john@example.com',
            'password' => $user->password
        ];
        $response = $this->actingAs($user)->put('/profile/'.$user->id, $editedUser);
        $this->assertDatabaseMissing('users',$editedUser);
        $response->assertInvalid(['name']);
        $this->assertDatabaseCount('users',1);
        $response->assertStatus(302);
    }
    public function test_profile_edit_validation_fails_email_is_empty():void
    {
        $user = User::factory()->create();
        $editedUser = [
            'name' => 'John Doe',
            'email' => '',
            'password' => $user->password
        ];
        $response = $this->actingAs($user)->put('/profile/'.$user->id, $editedUser);
        $this->assertDatabaseMissing('users',$editedUser);
        $response->assertInvalid(['email']);
        $this->assertDatabaseCount('users',1);
        $response->assertStatus(302);
    }
    public function test_profile_edit_validation_fails_email_is_taken():void
    {
        $user = User::factory()->create();
        $user2 = User::factory()->create();
        $editedUser = [
            'name' => 'John Doe',
            'email' => $user2->email,
            'password' => $user->password
        ];
        $response = $this->actingAs($user)->put('/profile/'.$user->id, $editedUser);
        $this->assertDatabaseMissing('users',$editedUser);
        $response->assertInvalid(['email']);
        $this->assertDatabaseCount('users',2);
        $response->assertStatus(302);
    }
}
