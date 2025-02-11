<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Notification;

class HomeController extends Controller
{
    private function calculateLevel($experience) {
        // Chaque niveau nécessite 100 points d'expérience
        return floor($experience / 100) + 1;
    }

    public function index()
    {
        if (Auth::check()) {
            $user = Auth::user();
            $experience = $user->experience ?? 0; // Récupère l'expérience ou 0 par défaut
            $level = $this->calculateLevel($experience);
            
            // Récupérer les notifications comme avant
            $notifications = Notification::where('user_id', Auth::id())
                ->orderBy('created_at', 'desc')
                ->get();
            
            return view('home', compact('notifications', 'level'));
        }
        
        return view('home');
    }
} 