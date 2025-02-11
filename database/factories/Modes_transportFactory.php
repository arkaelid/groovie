<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Modes_transport;

class Modes_transportFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Modes_transport::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        // Défini les modes de transport spécifiques
        $modes_transport = [
            [
                'type' => 'Van',
                'niveau' => 1,
                'groovies' => 100,
                'empreinte_carbone' => 10.5,
                'caracteristique' => 'Transport en groupe via van',
            ],
            [
                'type' => 'Covoiturage',
                'niveau' => 1,
                'groovies' => 80,
                'empreinte_carbone' => 8.0,
                'caracteristique' => 'Covoiturage pour réduire l\'empreinte carbone',
            ],
            [
                'type' => 'Bus',
                'niveau' => 2,
                'groovies' => 120,
                'empreinte_carbone' => 15.2,
                'caracteristique' => 'Transport en commun, plus éco-responsable',
            ],
            [
                'type' => 'Train',
                'niveau' => 2,
                'groovies' => 150,
                'empreinte_carbone' => 12.3,
                'caracteristique' => 'Voyage rapide et écologique',
            ],
            [
                'type' => 'Vélo',
                'niveau' => 3,
                'groovies' => 200,
                'empreinte_carbone' => 0.0,
                'caracteristique' => 'Mode de transport zéro émission',
            ],
            [
                'type' => 'Marche',
                'niveau' => 3,
                'groovies' => 250,
                'empreinte_carbone' => 0.0,
                'caracteristique' => 'Le transport le plus écologique',
            ],
        ];

        // Retourner un mode de transport aléatoire parmi les 6 définis
        return $this->faker->randomElement($modes_transport);
    }
}


