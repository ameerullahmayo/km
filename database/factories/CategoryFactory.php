<?php

namespace Database\Factories;

use App\Models\Category;

use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    protected $model = Category::class;

    public function definition()
    {
        return [
            'english_title' => $this->faker->word,
            'urdu_title' => $this->faker->word,
            'type' => $this->faker->word,
            'image_1' => $this->faker->imageUrl(),
            'image_2' => $this->faker->imageUrl(),
            'status' => $this->faker->randomElement(['0', '1']),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
