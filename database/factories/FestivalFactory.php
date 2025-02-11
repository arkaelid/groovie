<?php

namespace Database\Factories;

use App\Models\Festival;
use Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class FestivalFactory extends Factory
{
    protected $model = Festival::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nom_festival' => $title= $this->faker->words(3, true), // Génère un nom de festival aléatoire
            'slug' => Str::slug($title),// Génère un slug aléatoire
            'prix'=> $this->faker->randomFloat(2, 20, 200), // Génère un prix aléatoire
            'lieu_festival' => $this->faker->address, // Génère une adresse aléatoire
            'date_heure_debut' => $this->faker->dateTimeBetween('+15 days', '+30days '), // Génère une date de début aléatoire entre aujourd'hui et un mois
            'date_heure_fin' => $this->faker->dateTimeBetween('+10 days', '+1 month'), // Génère une date de fin aléatoire entre un mois et deux mois
            'image_festival' => $this->faker->randomElement(['terres-son.png', 'printemps-bourges.jpg']), // Sélectionne une image aléatoire entre les 2 proposées
            'type' => $this->faker->randomElement(['Rock', 'Rap', 'Electro']), // Sélectionne un type de festival aléatoire
        ];
    }
}