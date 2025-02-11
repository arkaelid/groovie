<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pause extends Model
{
    use HasFactory;

    public function users(){
        return $this->belongsToMany(User::class, 'pause_utilisateur', 'id_pause', 'id_utilisateur');
    }

    public function trajet(){
        return $this->belongsTo(Trajet::class, 'id_trajet', 'id');
    }
}
