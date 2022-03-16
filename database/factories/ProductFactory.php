<?php

namespace Database\Factories;

use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $categoryIds = \App\Models\Category::pluck('id');
        $categoryIdArr = [];

        foreach($categoryIds as $id){
          $categoryIdArr[] = $id;
        }

        return [
          'product_name' => $this->faker->word,
          'category_id' => Arr::random($categoryIdArr,1)[0],
          'price' => rand(1, 9) * 1000,
          'amount' => rand(1,444),
        ];
    }
}
