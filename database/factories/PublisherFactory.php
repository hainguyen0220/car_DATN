<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class GaraFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'=> $this->faker->name(),
            'email'=> $this->faker->unique()->safeEmail(),
            'address'=> $this->faker->address(),
            'describle'=> $this->faker->text($maxNbChars = 100),
        ];
    }
}
