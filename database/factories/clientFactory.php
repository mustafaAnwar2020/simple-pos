<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class clientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'=>$this->faker->name,
            'phone'=>$this->faker->phoneNumber(),
            'email'=>$this->faker->unique()->email(),
            'address'=>$this->faker->address()
        ];
    }
}
