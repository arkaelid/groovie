<?php

namespace Database\Seeders;

use App\Models\Actualite;
use Illuminate\Database\Seeder;
use App\Models\Festival;
use App\Models\{
    Partenaire,
    Offre,
    User,
    Trajet,
    Modes_transport
    };

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $users = User::factory(10)->create();



        $festivals = Festival::factory(15)->hasBillets(50)->create();
        $actualites = Actualite::factory(10)->create();
        foreach ($actualites as $actualite) {
            $actualite->festivals()->attach(
                $festivals->random(rand(1, 3))->pluck('id')->toArray()
            );
        }
        Modes_transport::factory()->count(6)->create();
        $trajets = Trajet::factory()->count(10)->create();
        // Crée des partenaires et leurs offres associées
        $partenaires = Partenaire::factory(10)->hasOffres(2)->create();

        // Crée des offres et les attache aux festivals
        foreach ($partenaires as $partenaire) {
            $offres = $partenaire->offres; // Récupère les offres du partenaire
            foreach ($offres as $offre) {
                // Attache l'offre aux festivals
                $offre->festivals()->attach(
                    $festivals->random(rand(1, 3))->pluck('id')->toArray()
                );
            }
        }

        foreach ($offres as $offre) {
           $offre->users()->attach(
                $users->random(rand(1, 3))->pluck('id')->toArray()
           );
        }
        foreach ($trajets as $trajet) {
            $trajet->utilisateurs()->attach(
                $users->random(rand(1, 3))->pluck('id')->toArray()
            );
        }

        foreach ($festivals as $festival){
            $festival->utilisateurs()->attach(
                $users->random(rand(1, 3))->pluck('id')->toArray()
            );
        }
        
    }
}
