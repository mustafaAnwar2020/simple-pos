<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class categoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        return [
            'ar'=>[
                'name'=>$this->faker->name,
            ],
            'en'=>[
                'name'=>$this->faker->name,
            ]
        ];
    }
}
