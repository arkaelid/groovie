<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Festival;
class BilletFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'code' => $this->faker->unique()->randomNumber(8),
            'prix_billet' => $this->faker->randomFloat(2, 0, 999),
            'id_festival' => Festival::factory(),
        ];
    }
}
