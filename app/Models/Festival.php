<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Festival extends Model
{
    use HasFactory;
    protected $fillable = [
        'lien', 
        'nom_festival',
        'prix',
        'lieu_festival',
        'date_heure_debut',
        'date_heure_fin',
    ];
    protected $casts = [
        'date_heure_debut' => 'datetime',
        'date_heure_fin' => 'datetime',
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
    
    public function billets(){
        return $this->hasMany(Billet::class, 'id_festival');
    }

    public function videos(){
        return $this->hasMany(Video::class, 'id_festival');
    }

    public function trajets(){
        return $this->hasMany(Trajet::class, 'id_festival');
    }

    public function utilisateurs(){
        return $this->belongsToMany(User::class, 'festival_user', 'id_festival', 'id_utilisateur')->withTimestamps();
    }

    public function preferences(){
        return $this->hasMany(Preference::class, 'id_festival');
    }

    public function offres(){
        return $this->belongsToMany(Offre::class, 'festival_offre', 'id_festival', 'id_offre');
    }

    public function notifications(){
        return $this->hasMany(Notification::class, 'id_festival')->withTimestamps();
    }

    public function actualites(){
        return $this->belongsToMany(Actualite::class, 'actualites_festivals', 'id_festival', 'id_actualite');
    }
}
