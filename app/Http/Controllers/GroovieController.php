<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Festival;
use App\Models\Offre;
use App\Models\Partenaire;
use Auth;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class GroovieController extends Controller
{
    public function index(){
        $avatars = File::files(public_path('img/avatar')); // Récupère les fichiers dans le dossier img/avatar
        $avatars = array_map(fn($file) => 'img/avatar/' . $file->getFilename(), $avatars); // Crée des chemins relatifs
        $user = Auth::user();
        $level = $user->experience;
        $level = intval($level / 10); 
        $userFestival = User::find($user->id)->festivals->where('date_heure_debut', '>', now());
        foreach ($userFestival as $festival) {
            $festival->joursRestants = Carbon::parse($festival->date_heure_debut)->diffInDays(now()); 
        }
       
        
        $offres = Offre::join('partenaires', 'offres.id_partenaire', '=', 'partenaires.id')
        ->select(
            'offres.id',
            'offres.nom_offre',
            'offres.points_groovie',
            'offres.reduction_en_pourcentage as reduction',
            'offres.informations_offre as informations',
            'offres.conditions_offre as conditions',
            'partenaires.nom as partenaire'
        )
        ->get();
            
        $types = Festival::select('type')->distinct()->pluck('type');

        $data = [
            'user' => $user,
            'level' => $level,
            'avatars' => $avatars,
            'festivals' => $userFestival,
            'offres' => $offres,
            'types' => $types
        ];

    return view('groovie.groovie', $data);
    }

    public function updateAvatar(Request $request)
    {
        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $user = Auth::user();

        if ($request->hasFile('avatar')) {
            // Supprimer l'ancien avatar s'il existe
            if ($user->avatar && file_exists(public_path('img/avatar/' . $user->avatar))) {
                unlink(public_path('img/avatar/' . $user->avatar));
            }

            // Générer un nom unique pour l'image
            $avatarName = time() . '.' . $request->avatar->extension();

            // Déplacer l'image dans le dossier public/img/avatar
            $request->avatar->move(public_path('img/avatar'), $avatarName);

            // Sauvegarder le nom du fichier dans la base de données
            $user->avatar = $avatarName;
            $user->save();

            return response()->json([
                'success' => true,
                'avatar' => $avatarName
            ]);
        }

        return response()->json([
            'success' => false,
        ], 400);
    }
    
    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        if ($request->has('firstname') && $request->has('lastname')) {
            $request->validate([
                'firstname' => 'required|string|max:255',
                'lastname' => 'required|string|max:255',
            ]);

            $user->firstname = $request->firstname;
            $user->lastname = $request->lastname;
        } else {
            $field = array_key_first($request->all());
            $value = $request->input($field);

            if ($field === 'password') {
                $request->validate([
                    'password' => 'required|string|min:8',
                ]);
                $user->password = Hash::make($value);
            } else {
                $request->validate([
                    $field => 'required|string|max:255',
                ]);
                $user->$field = $value;
            }
        }

        $user->save();

        return response()->json(['success' => true, 'message' => 'Profil mis à jour avec succès']);
    }

    public function closeAccount(Request $request)
    {
        $user = Auth::user();
        $user->etat = 'supprime';
        $user->save();

        Auth::logout();
        
        return response()->json([
            'success' => true,
            'message' => 'Compte clôturé avec succès',
            'redirect' => route('home')
        ]);
    }

    public function showOfferDetail($id)
{
    $offre = Offre::with('partenaire')->find($id);

    if (!$offre) {
        abort(404, 'Offre introuvable');
    }

    return view('groovie.offres-groovie-detail', compact('offre'));

}

public function useOffer(Request $request, $id)
{
    $user = Auth::user();
    $offre = Offre::findOrFail($id); // Récupérer l'offre par son ID

    // Vérifiez si l'utilisateur a suffisamment de groovies
    if ($user->groovies >= $offre->points_groovie) {
        // Soustraire les points de groovies de l'utilisateur
        $user->groovies -= $offre->points_groovie;
        
        $id_offre=$offre->id;
        $user->save(); 
        $user->offres()->attach($offre->id);

        // Rediriger vers la page groovie avec un message de succès
        return redirect()->route('groovie')->with('success', 'Offre enregistrée');
    } else {
        // Rediriger avec un message d'erreur si l'utilisateur n'a pas assez de groovies
        return redirect()->route('groovie')->with('error', 'Vous n\'avez pas assez de Groovies pour utiliser cette offre.');
    }
}

}
