<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Actualite extends Model
{
    use HasFactory;
    protected $fillable =[
        'type',
        'nom',
        'descriptif',
        'image',
    ];
    public function festivals(){
        return $this->belongsToMany(Festival::class, 'actualites_festivals', 'id_actualite', 'id_festival');
    }

}
