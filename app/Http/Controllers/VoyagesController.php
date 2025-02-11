<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Festival;
use App\Models\Trajet;
use Illuminate\Http\Request;

class VoyagesController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $festivals = $user->festivals->where('date_heure_fin', '>', now());
        $festivalDefaut = $user->festivals()->where('date_heure_debut', '>', now())->latest('festival_user.created_at')->first();
        $type = 'reserve';
        $trajetsUtilisateur = $festivalDefaut ? $festivalDefaut->trajets()
            ->whereHas('utilisateurs', function($query) use ($user, $type) {
                $query->where('utilisateur_id', $user->id)
                      ->where('type', $type); // Filtrer par 'type' dans la table pivot
            })->with('modeTransport')
            ->get() : collect();
        $trajetsReservesCount = $festivalDefaut ? $festivalDefaut->trajets()
            ->whereHas('utilisateurs', function($query) use ($user, $type) {
                $query->where('utilisateur_id', $user->id)
                      ->where('type', $type); // Filtrer par 'type' dans la table pivot
            })
            ->count() : 0;
        $trajetsEnregistresCount = $festivalDefaut ? $festivalDefaut->trajets()
            ->whereHas('utilisateurs', function($query) use ($user, $type) {
                $query->where('utilisateur_id', $user->id)
                      ->where('type', 'enregistre'); // Filtrer par 'type' dans la table pivot
            })
            ->count() : 0;
        
        // Récupérer les trajets (à adapter selon votre modèle de données)
        $trajetsFestival = $festivalDefaut ? $festivalDefaut->trajets()->with('modeTransport')
        ->get() : collect();

        return view('trajet.trajet', [
            'festivals' => $festivals,
            'festivalDefaut' => $festivalDefaut,
            'trajetsUtilisateur' => $trajetsUtilisateur,
            'type' => $type,
            'trajetsReservesCount' => $trajetsReservesCount,
            'trajetsEnregistresCount' => $trajetsEnregistresCount,
            'trajetsFestival' => $trajetsFestival,
        ]);
    }

    public function trajetsUtilisateur(Request $request)
    {
        $user = Auth::user();
        $festivalDefaut = $user->festivals()->where('date_heure_fin', '>', now())->latest()->first();
        $festival = Festival::where('slug', $request->search)->first();
        $type = $request->type; // Récupérer le type de trajet (réservé ou enregistré)

        $trajetsUtilisateur = $festival->trajets()
            ->whereHas('utilisateurs', function($query) use ($user, $type) {
                $query->where('utilisateur_id', $user->id)
                      ->where('type', $type); // Filtrer par type
            })
            ->with('modeTransport')
            ->get();
            $trajetsReservesCount = $festival ? $festival->trajets()
            ->whereHas('utilisateurs', function($query) use ($user, $type) {
                $query->where('utilisateur_id', $user->id)
                      ->where('type', 'reserve'); // Filtrer par 'type' dans la table pivot
            })
            ->count() : 0;
            $trajetsEnregistresCount = $festival ? $festival->trajets()
            ->whereHas('utilisateurs', function($query) use ($user, $type) {
                $query->where('utilisateur_id', $user->id)
                      ->where('type', 'enregistre'); // Filtrer par 'type' dans la table pivot
            })
            ->count() : 0;
            $trajetsFestival = $festival ? $festival->trajets()->with('modeTransport')
            ->get() : collect();
        return response()->json([
            'festivalDefaut' => $festivalDefaut,
            'trajetsUtilisateur' => $trajetsUtilisateur,
            'type' => $type,
            'trajetsEnregistresCount' => $trajetsEnregistresCount,
            'trajetsReservesCount'=>$trajetsReservesCount,
            'trajetsFestival'=>$trajetsFestival,
            'html' => view('layouts.partials.trajet_card', compact('trajetsUtilisateur', 'festivalDefaut', 'type'))->render(),
            'htmlTwo' => view('layouts.partials.trajet_card_two', compact( 'festivalDefaut', 'trajetsFestival'))->render(),

        ]);
    }
}