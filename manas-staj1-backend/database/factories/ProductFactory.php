<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Product;

class ProductFactory extends Factory
{
    protected $model = Product::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    // 'subcategory_id' => Subcategory::get()->random()->id,
    public function definition()
    {
        return [
            'type' => random_int(1, 4),
            'name' => $this->faker->name(),
            'price' => (string)random_int(200, 800),
            'description' => $this->faker->text(),
            'photoLink' => 'https://media-cldnry.s-nbcnews.com/image/upload/t_nbcnews-fp-1200-630,f_auto,q_auto:best/newscms/2019_33/2203981/171026-better-coffee-boost-se-329p.jpg',
            'frequency' => random_int(10, 400),
            'count' => random_int(20, 40)
        ];
    }
}
