<?php

namespace Tests\Feature;

use App\Models\Person;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Testing\Fakes\Fake;
use Tests\TestCase;

class InsertPageTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_if_insert_page_exist_and_can_be_opened():void
    {
        $response = $this->get('/insert');
        $response->assertStatus(200);
    }

    public function test_insert_validation_succed_form_is_sent():void
    {
        $person = [
            "name"=> "John Doe",
            "email"=> "John.doe@example.com",
            "post" => "Job Title"
        ];
        $this->assertDatabaseMissing('people',$person);
        $this->call('POST','/',$person);
        $this->assertDatabaseHas('people',$person);
    }

    public function test_insert_validation_fails_by_name():void
    {
        $person = [
            "name"=> "",
            "email"=> "John.doe@example.com",
            "post" => "Job Title"
        ];
        
        $this->assertDatabaseMissing('people',$person);

        $response = $this->call('POST','/',$person);

        $this->assertDatabaseMissing('people',$person);
        $response->assertInvalid(['name']);
       
    }

    public function test_insert_validation_fails_by_email():void
    {
        $person = [
            "name"=> "John Doe",
            "email"=> "John.example.com",
            "post" => "Job Title"
        ];
        
        $this->assertDatabaseMissing('people',$person);

        $response = $this->call('POST','/',$person);

        $this->assertDatabaseMissing('people',$person);
        $response->assertInvalid(['email']);
       
    }
    public function test_insert_validation_fails_by_job_title():void
    {
        $person = [
            "name"=> "John Doe",
            "email"=> "John.example.com",
            "post" => ""
        ];
        
        $this->assertDatabaseMissing('people',$person);

        $response = $this->call('POST','/',$person);

        $this->assertDatabaseMissing('people',$person);
        $response->assertInvalid(['post']);
       
    }
    
}
