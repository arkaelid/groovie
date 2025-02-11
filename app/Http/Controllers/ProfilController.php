<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfilController extends Controller
{
    public function update(Request $request)
    {
        $user = auth()->user();
        $field = $request->input('field');
        $value = $request->input('value');

        $validator = Validator::make($request->all(), [
            'field' => 'required|in:firstname,lastname,email,ville,password',
            'value' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => 'Données invalides'], 422);
        }

        if ($field === 'password') {
            $user->update([
                'password' => Hash::make($value)
            ]);
        } else {
            $user->update([
                $field => $value
            ]);
        }

        return response()->json(['success' => true, 'message' => 'Profil mis à jour avec succès']);
    }
}