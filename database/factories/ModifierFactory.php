<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
class ModifierFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = \App\Models\Modifier::class;
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'select_min_options' =>$this->faker->numerify(2),
            'select_max_options' =>$this->faker->numerify(2),
            'option_selected_times' =>  $this->faker->numerify(2),
            'status' => $this->faker->randomElement(['active','inactive']),
        ];
    }

}
