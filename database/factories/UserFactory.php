<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'firstname' => $this->faker->firstName(),
            'lastname' => $this->faker->lastName(),
            'email' => $this->faker->unique()->safeEmail(),
            'id_groover' => substr(md5(Str::uuid()), 0, 10),
            'pseudo' => $this->faker->unique()->userName(),
            'role' => $this->faker->randomElement(['admin', 'user', 'moderator']),
            'etat' => $this->faker->randomElement(['disponible', 'suspendu', 'supprime']),
            'ville' => $this->faker->city(),
            'experience' => $this->faker->numberBetween(0, 100), // Expérience entre 0 et 100
            'groovies' => $this->faker->numberBetween(0, 5000), // Points Groovies
            'qrcode' => Str::random(20), // Chaîne aléatoire unique pour le QR Code

            'email_verified_at' => now(),
            'password' => bcrypt('password'), // Hash du mot de passe
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
