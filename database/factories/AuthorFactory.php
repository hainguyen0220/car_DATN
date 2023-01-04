<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class AuthorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'full_name'=> $this->faker->name(),
            'dob'=> $this->faker->year($max = '2000'),
            'address'=> $this->faker->address(),
            'describle'=> $this->faker->text($maxNbChars = 100),
        ];
    }
}
