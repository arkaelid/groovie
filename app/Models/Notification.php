<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_festival',
        'id_utilisateur',
        'type',
        'description',
        'created_at',
        'updated_at',
    ];
    public function festival(){
        return $this->belongsTo(Festival::class, 'id_festival', 'id')->withTimestamps();
    }

    public function trajet(){
        return $this->belongsTo(Trajet::class, 'id_trajet', 'id');
    }

    public function utilisateur(){
        return $this->belongsTo(User::class, 'id_utilisateur', 'id');
    }

    public function utilisateurs(){
        return $this->belongsToMany(User::class, 'notification_user', 'id_notification', 'id_utilisateur');
    }
}
