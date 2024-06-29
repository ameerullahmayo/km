<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition()
    {
        $imageUrls = [
            $this->faker->imageUrl(640, 480, 'food', true),
            $this->faker->imageUrl(640, 480, 'food', true),
            $this->faker->imageUrl(640, 480, 'food', true),
        ];

        return [
            'category_id' => \App\Models\Category::factory(),
            'english_title' => $this->faker->word,
            'urdu_title' => $this->faker->word,
            'english_description' => $this->faker->sentence,
            'urdu_description' => $this->faker->sentence,
            'price' => $this->faker->randomFloat(2, 10, 1000),
            'sale_price' => $this->faker->randomFloat(2, 5, 500),
            'quantity' => $this->faker->numberBetween(1, 100),
            'weight' => $this->faker->word,
            'english_type' => $this->faker->word,
            'urdu_type' => $this->faker->word,
            'images' => json_encode($imageUrls),
            'status' => $this->faker->randomElement(['0', '1']),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}