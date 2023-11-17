<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Person;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cv>
 */
class CvFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $personId = $this->faker->randomElement(Person::pluck('id')->toArray());

        return [
            'person_id' => $personId,
            'body' => fake()->text()
        ];
    }
}
