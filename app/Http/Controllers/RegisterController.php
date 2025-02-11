<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Str, Auth;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'fullname' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6|max:20',
            'ville' => 'required|string|max:255',
        ]);

        // Séparer le nom complet en prénom et nom
        $fullname = $request->input('fullname');
        $nameParts = explode(' ', $fullname, 2);
        $firstname = $nameParts[0];
        $lastname = isset($nameParts[1]) ? $nameParts[1] : '';

        $user = new User();
        $user->firstname = $firstname;
        $user->lastname = $lastname;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->role = 'user';
        $user->etat = 'disponible';
        $user->experience = 0;
        $user->groovies = 0;
        $user->pseudo = null;
        $user->ville = $request->ville;
        $user->qrcode = Str::uuid();
        $user->id_groover =  Str::random(20);
        $user->save();


        Auth::login($user);

        return redirect()->route('home')->with('success', 'Votre compte a bien été créé');
    }
}
