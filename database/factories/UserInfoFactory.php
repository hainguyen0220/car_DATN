<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class UserInfoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'full_name' => $this->faker->name(),
            'avatar' => $this->faker->imageUrl(300, 300, 'cats'),
            'dob' => $this->faker->date($format = 'Y-m-d', $max = 'now - 30 years'),
            'address' => $this->faker->address(),
        ];
    }
}
