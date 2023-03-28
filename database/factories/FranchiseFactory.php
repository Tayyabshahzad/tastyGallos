<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class FranchiseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => $this->faker->name(),
            'name' =>$this->faker->name(),
            'contact_phone' =>$this->faker->name(),
            'contact_email' =>$this->faker->name(),
            'vat' =>$this->faker->name(),
            'address' =>$this->faker->name(),
            'delivery_charge' =>$this->faker->name(),
            'pickup' =>$this->faker->name(),
            'delivery' =>$this->faker->name(),
            'about' =>$this->faker->name(),
            'busy_time' =>$this->faker->name(),
            'free_time' =>$this->faker->name(),
            'status' => $this->faker->randomElement(['active','inactive']),
        ];
    }
}
