<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use Notifiable, HasFactory;

    //apppel de notre table "utilisateur" créer dans notre BD
    protected $table = 'utilisateur';

    protected $primaryKey = 'id_utilisateur';
    public $timestamps = false; //a false car created_at et updated_at non presents dans ma BD 

    protected $fillable = [
        'nom',
        'email',
        'role',
        'id_vet',
        'id_entraineur',
        'id_licence',
        'mdp',
    ];

    protected $hidden = [
        'mdp',
    ];

    public function getAuthPassword()
    {
        return $this->mdp;
    }

    public function isEntraineur()
    {
        return $this->role === 'entraineur';
    }

    public function isVeterinaire()
    {
        return $this->role === 'veterinaire';
    }

    public function isCavalier()
    {
        return $this->role === 'cavalier';
    }
}
