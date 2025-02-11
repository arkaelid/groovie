<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partenaire extends Model
{
    use HasFactory;

    public function offres(){
        return $this->hasMany(Offre::class, 'id_partenaire');
    }
}
