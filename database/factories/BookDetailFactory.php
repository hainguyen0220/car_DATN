<?php

namespace Database\Factories;

use App\Models\Author;
use App\Models\CategoryDetail;
use App\Models\Gara;
use Illuminate\Database\Eloquent\Factories\Factory;

class CarDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $garaId = [];
        foreach (Gara::all() as $slider){
            array_push($garaId, $slider->id);
        }

        $authorId = [];
        foreach (Author::all() as $slider){
            array_push($authorId, $slider->id);
        }

        $categoryDetailId = [];
        foreach (CategoryDetail::all() as $slider){
            array_push($categoryDetailId, $slider->id);
        }

        return 
            [
                'gara_id' => $this->faker->randomElement($array = $garaId),
                'author_id' => $this->faker->randomElement($array = $authorId),
                'category_detail_id' => $this->faker->randomElement($array = $categoryDetailId),
                'publish_date' => rand(1900,2022),
                'status' => $this->faker->randomElement($array =array('con','het')) ,
                'describe' => $this->faker->text($maxNbChars = 1000) ,

            ];
    }
}
