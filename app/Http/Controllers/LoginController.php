<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;

class LoginController extends Controller
{
    public function login()
    {
        // Validation des champs
        request()->validate([
            'email' => 'required',
            'password' => 'required'
        ]);
    
        // Tentative d'authentification
        if (Auth::attempt([
            'email' => request('email'),
            'password' => request('password')
        ])) {
            if (Auth::user()->etat === 'supprime') {
                Auth::logout();
                return back()->with('error', 'Votre compte a été supprimé. Veuillez contacter l\'administrateur.');
            }elseif(Auth::user()->etat === 'suspendu'){
                Auth::logout();
                return back()->with('error', 'Votre compte a été suspendu. Veuillez contacter l\'administrateur.');
            }
            // Récupération de l'utilisateur authentifié
            $user = Auth::user();
            
            // Récupération des données de la session
            $sessionUser = session('user');
            $billet = session('billet');
    
            // Vérification si l'utilisateur en session correspond à celui qui vient de se connecter
            if ($sessionUser && $sessionUser->email === $user->email) {
                if ($billet) {
                    // Récupération de l'ID du festival associé au billet
                    $id_festival = $billet->id_festival;
    
                    // Vérification si l'utilisateur est déjà inscrit au festival
                    if (!$user->festivals()->where('id_festival', $id_festival)->exists()) {
                        // Association de l'utilisateur au festival
                        $user->festivals()->attach($id_festival);
    
                        // Suppression des données de session car elles ne sont plus nécessaires
                        session()->forget(['user', 'billet']);
    
                        return back()->with('successbillet', 'Billet validé, vous avez accès au festival.');
                    }
                    session()->forget(['user', 'billet']);
                }
            }else{
                session()->forget(['user', 'billet']);
                return back()->with('success', 'Vous êtes connecté.');
            }
    
            return back()->with('success', 'Vous êtes connecté.');
        }
    
        // Si l'authentification échoue
        return back()->with('error', 'Identifiants incorrects')->withInput();
    }
    
}
