<?php

namespace Tests\Feature;

use App\Models\Cv;
use App\Models\Person;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CvDatsTest extends TestCase
{
    use RefreshDatabase;

    public function test_if_cv_page_is_exist_with_person(): void
    {
        $user = User::factory()->create();
        $person = Person::factory()->create();

        $response = $this->actingAs($user)->get('/cv/'.$person['id']);

        $response->assertStatus(200);
        $response->assertSee($person['name']);
    }

    public function test_if_cv_can_be_added_to_a_person(): void
    {
        $user = User::factory()->create();
        $person = Person::factory()->create();
        $cv = Cv::factory()->create();

        $response = $this->actingAs($user)->get('/cv/'.$person['id']);

        $response->assertStatus(200);
        $response->assertSee($person['name']);
        $response->assertSee($cv['text']);

    }

    public function test_if_person_can_have_many_cvs(): void
    {
        $user = User::factory()->create();
        $person = Person::factory()->create();
        Cv::factory(2)->create();

        $response = $this->actingAs($user)->get('/cv/'.$person['id']);

        $response->assertStatus(200);
        $this->assertDatabaseCount('cvs', 2);
    }

    public function test_creating_new_cv_validation_suceed_new_record_is_stored(): void
    {
        $person = Person::factory()->create();
        $user = User::factory()->create();
        $this->assertDatabaseEmpty('cvs');
        $cv = [
            'id' => $person->id,
            'textarea' => 'This is a CV body',

        ];
        $response = $this->actingAs($user)->post('/cv', $cv);

        $this->assertDatabaseCount('cvs', 1);
        $response->assertStatus(302);
    }

    public function test_creating_new_cv_validation_fails_new_record_is_not_stored(): void
    {
        $person = Person::factory()->create();
        $user = User::factory()->create();
        $this->assertDatabaseEmpty('cvs');
        $cv = [
            'id' => $person->id,
            'textarea' => '',

        ];
        $response = $this->actingAs($user)->post('/cv', $cv);
        $response->assertInvalid(['textarea']);
        $this->assertDatabaseCount('cvs', 0);
        $response->assertStatus(302);
    }

    public function test_editing_cv_suceed_record_is_updated(): void
    {
        $person = Person::factory()->create();
        $user = User::factory()->create();
        $cv = Cv::factory()->create();
        $newCv = [
            'id' => $person->id,
            'textarea' => 'Updated text',

        ];
        $response = $this->actingAs($user)->put('/cv/'.$cv->id, $newCv);
        $this->assertDatabaseHas('cvs', ['body' => 'Updated text']);
        $this->assertDatabaseCount('cvs', 1);
        $response->assertStatus(302);
    }

    public function test_editing_cv_suceed_record_is_not_updated(): void
    {
        $person = Person::factory()->create();
        $user = User::factory()->create();
        $cv = Cv::factory()->create();
        $newCv = [
            'id' => $person->id,
            'textarea' => '',

        ];
        $response = $this->actingAs($user)->put('/cv/'.$cv->id, $newCv);
        $this->assertDatabaseMissing('cvs', ['body' => '']);
        $this->assertDatabaseCount('cvs', 1);
        $response->assertStatus(302);
    }

    public function test_deleting_cv(): void
    {
        $user = User::factory()->create();
        $person = Person::factory()->create();
        $cv = Cv::factory(2)->create()->first();

        $this->assertDatabaseCount('cvs', 2);
        $this->assertDatabaseHas('cvs', ['body' => $cv['body']]);

        $response = $this->actingAs($user)->call('delete', '/cv/'.$cv['id']);

        $response->assertStatus(302);

        $this->assertDatabaseCount('cvs', 1);
        $this->assertDatabaseMissing('cvs', ['body' => $cv['body']]);
    }
}
