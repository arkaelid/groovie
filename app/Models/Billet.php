<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Billet extends Model
{
    use HasFactory;

    public function festival(){

        return $this->belongsTo(Festival::class, 'id_festival', 'id');
        
    }
    
}
