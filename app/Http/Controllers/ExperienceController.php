<?php

namespace App\Http\Controllers;

use App\Models\Billet;
use Illuminate\Http\Request;
use Auth;
class ExperienceController extends Controller
{
    public function index()
    {
        if(session('billet') || Auth::check()){
            return view('experience.experience');
        } else {
            return back();
        }
    }
} 