<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DeleteProfileTest extends TestCase
{
    use RefreshDatabase;
    public function test_deleting_cv():void
    {
        $user = User::factory()->create();

        $this->assertDatabaseCount('users',1);

        $response = $this->actingAs($user)->delete('/profile/'.$user["id"]);
        
        $this->assertDatabaseMissing('users',$user->toArray());
        $response->assertStatus(200);

        $this->assertDatabaseCount('users',0);

    }
}