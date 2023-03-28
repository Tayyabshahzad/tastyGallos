<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = \App\Models\Product::class;
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'description' =>$this->faker->name(),
            'sell_on_its_own' =>$this->faker->randomElement(['yes','no']),
            'price' =>  $this->faker->numerify(2),
            'sale_price' =>  $this->faker->numerify(2),
            'vat' =>  $this->faker->numerify(2),
            'status' => $this->faker->randomElement(['active','inactive']),
        ];
    }
}
