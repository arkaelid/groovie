<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modes_transport extends Model
{
    use HasFactory;

    protected $table = 'modes_transport';

    public function preferences(){
        return $this->hasMany(Preference::class, 'id_mode_transport');
    }

    public function trajets(){
        return $this->hasMany(Trajet::class, 'id_mode_transport');
    }
    
}
