<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\CategoryDetail;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'category_name' => 'Danh mục'.Str::random(4),
        ];
    }
    public function configure()
    {
        return $this->afterCreating(function (Category $category) {
            CategoryDetail::factory(5)->create(['category_id' => $category->id]);
        });
    }
}
