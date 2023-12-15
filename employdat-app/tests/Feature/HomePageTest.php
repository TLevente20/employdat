<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Person;
use App\Models\User;
use Illuminate\Database\Console\DumpCommand;
use Spatie\LaravelIgnition\Recorders\DumpRecorder\Dump;

class HomePageTest extends TestCase
{
    use RefreshDatabase;

    public function test_home_exist_and_open(): void
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/');

        $response->assertStatus(200);
    }

    public function test_home_ordering_exist():void
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/order/name');
        $response->assertStatus(200);

        $response = $this->actingAs($user)->get('/order/email');
        $response->assertStatus(200);

        $response = $this->actingAs($user)->get('/order/post');
        $response->assertStatus(200);

    }

    public function test_if_pagination_works(): void
    {
        $user = User::factory()->create();
        $people = Person::factory(9)->create();
        $person = $people->last();

        $response = $this->actingAs($user)->get('/');

        $this->assertDatabaseHas('people', $person->toArray());
        $response->assertDontSee($person->name);
        $response->assertStatus(200);
    }
    public function test_if_search_list_the_results():void
    {
        $user = User::factory()->create();
        $people = Person::factory(10)->create();
        $personToFind = $people->first();
        $personNotToFind = $people->skip(1)->first();

        $response = $this->actingAs($user)->get('/search?name='.$personToFind->toArray()['name']);
        
        $response->assertViewHas('people', function ($collection) use ($personToFind){
            return $collection->contains($personToFind);
        });
        $response->assertDontSee($personNotToFind->toArray()['name']);
        $response->assertStatus(200);
    }
}
