<?php

namespace Tests\Feature;

use App\Models\Person;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DatsDataTest extends TestCase
{
    use RefreshDatabase;
 
    public function test_if_home_gets_item() : void 
    {
        $user = User::factory()->create();
        $people = Person::factory(3)->create();
        $person = $people->first();

        $this->assertModelExists($person);

        $response = $this->actingAs($user)->get('/');

        $response->assertViewHas('people',  function ($collection) use ($person){
            return $collection->contains($person);
        });
        $response->assertStatus(200);
    }

    public function test_if_people_table_has_records():void
    {
        $this->assertDatabaseEmpty('people');

        Person::factory(3)->create();

        $this->assertDatabaseCount('people',3);
    }


    public function test_person_can_be_deleted():void
    {
        $user = User::factory()->create();
        $person = Person::factory()->create()->toArray();

        $this->assertDatabaseHas('people',$person);
        $response = $this->actingAs($user)->delete('person/'.$person["id"]);
        $this->assertDatabaseMissing('people',$person);
        $response->assertStatus(302);
    }

    public function test_person_can_be_edited_validation_confirmed():void
    {
        $user = User::factory()->create();
        $person = Person::factory()->create()->toArray();

        $this->assertDatabaseHas('people',[
            "name" => $person["name"],
            "email" => $person["email"],
            "post" => $person["post"]
        ]);

        $response = $this->actingAs($user)->put('person/'.$person["id"],[
            "name" => "John Doe",
            "email" => $person["email"],
            "post" => $person["post"]
        ]);

        $this->assertDatabaseHas('people',[
            "name" => "John Doe",
            "email" => $person["email"],
            "post" => $person["post"]
        ]);
        $response->assertStatus(302);
    }

    public function test_person_can_be_edited_validation_fails():void
    {
        $user = User::factory()->create();
        $person = Person::factory()->create()->toArray();

        $this->assertDatabaseHas('people',[
            "name" => $person["name"],
            "email" => $person["email"],
            "post" => $person["post"]
        ]);

        $response = $this->actingAs($user)->put('person/'.$person["id"],[
            "name" => "",
            "email" => $person["email"],
            "post" => $person["post"]
        ]);

        $this->assertDatabaseMissing('people',[
            "name" => "",
            "email" => $person["email"],
            "post" => $person["post"]
        ]);
        $this->assertDatabaseHas('people',[
            "name" => $person["name"],
            "email" => $person["email"],
            "post" => $person["post"]
        ]);
        $response->assertStatus(302);
    }
}
