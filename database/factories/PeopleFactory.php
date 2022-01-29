<?php

namespace Database\Factories;

use App\Models\Language;
use Illuminate\Database\Eloquent\Factories\Factory;

class PeopleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->firstName(),
            'surname' => $this->faker->lastName(),
            'mobile_number' => $this->faker->e164PhoneNumber(),
            'sa_id' => $this->faker->unique()->isbn13(),
            'email' => $this->faker->unique()->safeEmail(),
            'birthdate' => $this->faker->DateTime(),
            'language' => Language::inRandomOrder()->first()->id,
        ];
    }
}
