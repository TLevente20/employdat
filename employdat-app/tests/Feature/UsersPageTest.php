<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UsersPageTest extends TestCase
{
    use RefreshDatabase;

     public function test_profile_page_is_displayed(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->get('/profile');

        $response->assertOk();
    }

    public function test_profile_register_page_is_displayed(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->get('/profile/create');

        $response->assertOk();
    }
    public function test_home_ordering_exist():void
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/profile/order/name');
        $response->assertOk();

        $response = $this->actingAs($user)->get('/profile/order/created_at');
        $response->assertOk();

        $response = $this->actingAs($user)->get('/profile/order/email');
        $response->assertOk();

        $response = $this->actingAs($user)->get('/profile/order/email_verified_at');
        $response->assertOk();
    }
    public function test_if_search_list_the_results():void
    {
        $personToFind = User::factory()->create();
        $personNotToFind = User::factory()->create();

        $response = $this->actingAs($personToFind)->get('/profile/search?name='.$personToFind->toArray()['name']);
        
        $response->assertViewHas('users', function ($collection) use ($personToFind){
            return $collection->contains($personToFind);
        });
        $response->assertDontSee($personNotToFind->toArray()['name']);
        $response->assertOk();
    }
}
