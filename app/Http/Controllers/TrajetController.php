<?php

namespace App\Http\Controllers;

use App\Models\Festival;
use App\Models\Trajet;
use Illuminate\Http\Request;
use Auth;
class TrajetController extends Controller
{
    public function details(Trajet $trajet)
    {
        $idTrajet  = $trajet->id;
        $trajet = Trajet::with('modeTransport')->find($idTrajet);
        $modeTransport = $trajet->modeTransport;
        $seconds = strtotime($trajet->duree) - strtotime('00:00:00');
        $trajet_heure_fin = \Carbon\Carbon::parse($trajet->date_heure)->addSeconds($seconds);
        $festival = $trajet->festival;
        // Chiant sur 20 à faire, merci chat
        $parts = explode("\n", $festival->lieu_festival);
        $ville = preg_replace('/^\d+\s/', '', $parts[1]);
        $dureeInterval = \Carbon\Carbon::createFromFormat('H:i:s', '00:00:00')->addSeconds($seconds);        
        $data = [
            'trajet' => $trajet,
            'modeTransport' => $modeTransport,
            'trajet_heure_fin' => $trajet_heure_fin,
            'festival' => $festival,
            'ville' => $ville,
            'dureeInterval' => $dureeInterval,
        ];
        return view('trajet.details', $data);
    }

    public function reserverTrajet(Trajet $trajet){
        $user = Auth::user();
        $userTrajet = $user->trajets->where('id', $trajet->id)->first();
        if (!$userTrajet){
            $user->trajets()->attach($trajet->id, ['type' => 'reserve']);
            $user->groovies += $trajet->groovies;
            $user->save();
            return redirect()->route('trajet')->with('success', 'Trajet réservé.');
        }elseif($userTrajet->pivot->type !== 'reserve'){
            $user->trajets()->updateExistingPivot($trajet->id, ['type' => 'reserve']);      
            $user->groovies += $trajet->groovies;
            $user->save();      
            return redirect()->route('trajet')->with('success', 'Trajet réservé.');
        }else{
            return redirect()->route('trajet')->with('error', 'Trajet déjà réservé.');
        }
    }

    public function enregistrerTrajet(Trajet $trajet){
        $user = Auth::user();
        $userTrajet = $user->trajets->where('id', $trajet->id)->first();
        if (!$userTrajet){
            $user->trajets()->attach($trajet->id, ['type' => 'enregistre']);
            return redirect()->route('trajet')->with('success', 'Trajet enregistré.');
        }else{
            return redirect()->route('trajet')->with('error', 'Trajet déjà réservé.');
        }
    }
} 