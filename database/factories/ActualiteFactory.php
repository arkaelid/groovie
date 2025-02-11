<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ActualiteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'descriptif' => $this->faker->text(100),
            'nom' => $this->faker->name,
            'image' => $this->faker->randomElement(['actualites/solidays.jpg', 'actualites/festival.jpg', 'actualites/grooApp.png']),
            'type' => $this->faker->randomElement(['Application', 'Nouveauté', 'Événement']),
        ];
    }
}
