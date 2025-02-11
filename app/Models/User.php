<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'firstname',
        'lastname',
        'email',
        'password',
        'ville',
        'id_groover',
        'avatar',
        'etat',
        'pseudo',
        'groovies',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    
    public function preferences(){
        return $this->hasMany(Preference::class, 'id_utilisateur');
    }

    public function festivals(){
        return $this->belongsToMany(Festival::class, 'festival_user', 'id_utilisateur', 'id_festival')->withTimestamps();
    }

    public function notifications(){
        return $this->hasMany(Notification::class, 'id_utilisateur');
    }

    public function notifications_envoyees(){
        return $this->belongsToMany(Notification::class, 'notification_user', 'id_utilisateur', 'id_notification');
    }

    public function pauses(){
        return $this->belongsToMany(Pause::class, 'pause_utilisateur', 'id_utilisateur', 'id_pause');
    }

    public function trajets(){
        return $this->belongsToMany(Trajet::class, 'trajet_utilisateur', 'utilisateur_id', 'trajet_id')
            ->withPivot('type')
            ->withTimestamps();    
    }
    
    public function offres(){
        return $this->belongsToMany(Offre::class, 'offre_utilisateur', 'id_utilisateur', 'id_offre')->withTimestamps();
    }

    public function getLevel()
    {
        return floor(($this->experience ?? 0) / 100) + 1;
    }
}
