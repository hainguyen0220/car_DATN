<?php

namespace Database\Factories;

use App\Models\Car;
use App\Models\CarDetail;
use Illuminate\Database\Eloquent\Factories\Factory;

class CarFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
                'car_name' => $this->faker->name(),
                'total_quantity' => rand(10,100),
                'image' =>  $this->faker->imageUrl(300, 300, 'cats'),

            ];
    }

    public function configure(){
        return $this->afterCreating(function (Car $car) {
            CarDetail::factory(1)->create(['car_id' => $car->id]);
         });

    }
}
