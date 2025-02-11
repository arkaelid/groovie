<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trajet extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'heure',
        'groovies',
        'transport',
        'date'
    ];
    protected $casts = [
        'date_heure' => 'datetime',
    ];

    public function festival(){
        return $this->belongsTo(Festival::class, 'id_festival', 'id');
    }

    public function modeTransport(){
        return $this->belongsTo(Modes_transport::class, 'id_mode_transport', 'id');
    }

    public function utilisateurs(){
        return $this->belongsToMany(User::class, 'trajet_utilisateur', 'trajet_id', 'utilisateur_id')
            ->withPivot('type')
            ->withTimestamps();   
    }

    public function pauses(){
        return $this->hasMany(Pause::class, 'id_trajet', 'id');
    }

    public function notifications(){
        return $this->hasMany(Notification::class, 'id_trajet', 'id');
    }

    public function offres(){
        return $this->belongsToMany(Offre::class, 'offre_trajet', 'id_trajet', 'id_offre');
    }
}
