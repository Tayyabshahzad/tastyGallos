<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class FaqFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = \App\Models\Faq::class;
    public function definition()
    {

        return [
            'question' => $this->faker->name(),
            'answer' =>$this->faker->name(),
            'position' =>$this->faker->numerify('##'),
            'status' => $this->faker->randomElement(['active','inactive']),
        ];
    }
}
