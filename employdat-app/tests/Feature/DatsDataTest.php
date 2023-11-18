<?php

namespace Tests\Feature;

use App\Models\Person;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DatsDataTest extends TestCase
{
    use RefreshDatabase;
 
    public function test_if_home_gets_item() : void 
    {
        $people = Person::factory(3)->create();
        $person = $people->first();

        $this->assertModelExists($person);

        $response = $this->get('/');

        $response->assertViewHas('people',  function ($collection) use ($person){
            return $collection->contains($person);
        });
    }

    public function test_if_people_table_has_records():void
    {
        $this->assertDatabaseEmpty('people');

        Person::factory(3)->create();

        $this->assertDatabaseCount('people',3);
    }


    public function test_person_can_be_deleted():void
    {
        $person = Person::factory()->create()->toArray();

        $this->assertDatabaseHas('people',$person);
        $this->call('delete','/'.$person["id"]);
        $this->assertDatabaseMissing('people',$person);
    }

    public function test_person_can_be_edited_validation_confirmed():void
    {
        $person = Person::factory()->create()->toArray();

        $this->assertDatabaseHas('people',[
            "name" => $person["name"],
            "email" => $person["email"],
            "post" => $person["post"]
        ]);

        $this->call('patch','/'.$person["id"],[
            "name" => "John Doe",
            "email" => $person["email"],
            "post" => $person["post"]
        ]);

        $this->assertDatabaseHas('people',[
            "name" => "John Doe",
            "email" => $person["email"],
            "post" => $person["post"]
        ]);
    }

    public function test_person_can_be_edited_validation_fails():void
    {
        $person = Person::factory()->create()->toArray();

        $this->assertDatabaseHas('people',[
            "name" => $person["name"],
            "email" => $person["email"],
            "post" => $person["post"]
        ]);

        $this->call('patch','/'.$person["id"],[
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
    }
}
