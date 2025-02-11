<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Trajet;

class TrajetFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Trajet::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nom' => $this->faker->word(), // Nom aléatoire
            'date_heure' => $this->faker->dateTimeBetween('now', '+1 year'), // Date et heure aléatoires
            'groovies' => $this->faker->numberBetween(10, 500), // Points Groovie aléatoires
            'lieu_depart' => $this->faker->city(), // Ville aléatoire comme lieu de départ
            'empreinte_carbone' => $this->faker->randomFloat(2, 0.1, 50), // Empreinte carbone aléatoire
            'duree' => $this->faker->time('H:i:s'), // Durée au format heure:min:sec
            'distance' => $this->faker->numberBetween(10, 200), // Distance aléatoire
            'nb_personnes' => $this->faker->numberBetween(1, 10), // Nombre de personnes aléatoire
            'id_mode_transport' => $this->faker->numberBetween(1, 6), // Id du mode de transport aléatoire
            'id_festival' => $this->faker->numberBetween(1, 2), // Id du festival aléatoire
            'type' => $this->faker->randomElement(['Aller', 'Retour']),
            'prix' => $this->faker->randomFloat(2, 0, 20), // Prix aléatoire

        ];
    }
}
