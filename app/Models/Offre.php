<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offre extends Model
{
    use HasFactory;

    public function festivals(){
        return $this->belongsToMany(Festival::class, 'festival_offre', 'id_offre', 'id_festival');
    }

    public function users(){
        return $this->belongsToMany(User::class, 'offre_utilisateur', 'id_offre', 'id_utilisateur')->withTimestamps();
    }

    public function trajets(){
        return $this->belongsToMany(Trajet::class, 'offre_trajet', 'id_offre', 'id_trajet')->withTimestamps();
    }

    public function partenaire(){
        return $this->belongsTo(Partenaire::class, 'id_partenaire', 'id');
    }
  
   
}
