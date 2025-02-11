<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class OffreFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nom_offre' => $this->faker->words(3, true), // Génère un nom aléatoire pour l'offre (ex: "Offre spéciale Groovie")
            'points_groovie' => $this->faker->numberBetween(50, 500), // Points aléatoires entre 50 et 500
            'reduction_en_pourcentage' => $this->faker->numberBetween(5, 50), // Réduction aléatoire entre 5% et 50%
            'informations_offre' => $this->faker->optional()->text(200), // Informations supplémentaires (facultatives), max 200 caractères
            'conditions_offre' => $this->faker->sentence(10), // Conditions (ex: "Valable uniquement sur certains produits")
        ];
        
    }
}
