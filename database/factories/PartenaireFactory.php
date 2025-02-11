<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PartenaireFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nom' => $this->faker->word(), 
            'cle_api'=> $this->faker->uuid(),
            'login'=> $this->faker->unique()->safeEmail(),
            'password' => bcrypt('password'), // Hash du mot de passe

        ];
    }
}
