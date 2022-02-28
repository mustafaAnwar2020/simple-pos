<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\category;
class productFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'category_id'=>category::all()->random()->id,
            'sale_price'=>$this->faker->numberBetween(3000,15000),
            'purchase_price'=>$this->faker->numberBetween(2000,10000),
            'stock'=>$this->faker->numberBetween(5,100),
            'ar'=>[
                'name'=>$this->faker->text(),
                'description'=>$this->faker->text(),
            ],
            'en'=>[
                'name'=>$this->faker->text(),
                'description'=>$this->faker->text(),
            ]
        ];
    }
}
