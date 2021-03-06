<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
class profileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::all()->random()->id,
            'address' => $this->faker->address(),
            'phone' => $this->faker->phoneNumber(),
            'contact' => $this->faker->url()
        ];
    }
}
