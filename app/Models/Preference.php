<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Preference extends Model
{
    use HasFactory;

    public function festival(){
        return $this->belongsTo(Festival::class, 'id_festival', 'id');
    }

    public function utilisateur(){
        return $this->belongsTo(User::class, 'id_utilisateur', 'id');
    }

    public function mode_transport(){
        return $this->belongsTo(Mode_transport::class, 'id_mode_transport', 'id');
    }

    
}
