<?php

namespace Tests\Feature;
use App\Models\Person;
use App\Models\Cv;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CvDatsTest extends TestCase
{
    use RefreshDatabase;

    public function test_if_cv_page_is_exist_with_person(): void
    {
        $person = Person::factory()->create();
        
        $response = $this->get('/cv'.$person["id"]);

        $response->assertStatus(200);
        $response->assertSee($person["name"]);
    }

    public function test_if_cv_can_be_added_to_a_person():void
    {
        $person = Person::factory()->create();
        $cv = Cv::factory()->create();

        $response = $this->get('/cv'.$person["id"]);

        $response->assertStatus(200);
        $response->assertSee($person["name"]);
        $response->assertSee($cv["text"]);

    }

    public function test_if_person_can_have_many_cvs():void
    {
        $person = Person::factory()->create();
        Cv::factory(2)->create();

        $response = $this->get('/cv'.$person["id"]);
        $response->assertStatus(200);
        $this->assertDatabaseCount('cvs',2);
    }

    public function test_creating_new_cv_validation_suceed_new_record_is_stored():void
    {
        $person = Person::factory()->create();

        $this->assertDatabaseEmpty('cvs');

        $this->call('post','/cv'.$person["id"],["textarea" => "Text of the body"]);

        $this->assertDatabaseHas('cvs',["body" => "Text of the body"]);
    }

    public function test_creating_new_cv_validation_fails_new_record_is_not_stored():void
    {
        $person = Person::factory()->create();

        $this->assertDatabaseEmpty('cvs');

        $response = $this->call('post','/cv'.$person["id"],["textarea" => ""]);
        $response->assertStatus(302);
        $response->assertInvalid('textarea');
        $this->assertDatabaseEmpty('cvs');

    }

    public function test_editing_cv_suceed_record_is_updated():void
    {
        $person = Person::factory()->create();
        $cv = Cv::factory()->create();

        $response = $this->call('patch','/cv/'.$person["id"].'/'.$cv["id"],["textarea" => "Updated text"]);

        $response->assertStatus(200);
        $this->assertDatabaseHas('cvs',["body" => "Updated text"]);
        $response->assertViewHas('message',"CV is updated!");
    }

    public function test_editing_cv_fails_record_is_not_updated():void
    {
        $person = Person::factory()->create();
        $cv = Cv::factory()->create();

        $response = $this->call('patch','/cv/'.$person["id"].'/'.$cv["id"],["textarea" => ""]);

        $response->assertStatus(200);
        $this->assertDatabaseHas('cvs',["body" => $cv["body"]]);
        $response->assertViewHas('message',"CV cannot be updated to empty!");
    }

    public function test_deleting_cv():void
    {
        $person = Person::factory()->create();
        $cv = Cv::factory(2)->create()->first();

        $this->assertDatabaseCount('cvs',2);
        $this->assertDatabaseHas('cvs',["body" => $cv["body"]]);

        $response = $this->call('get','/cv/'.$person["id"].'/'.$cv["id"]);
        
        $response->assertStatus(200);

        $this->assertDatabaseCount('cvs',1);
        $this->assertDatabaseMissing('cvs',["body" => $cv["body"]]);
    }

}
