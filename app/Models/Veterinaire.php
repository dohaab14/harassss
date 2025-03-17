<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Veterinaire extends Model
{
    protected $table = 'veterinaire';

    protected $primaryKey = 'id_vet'; 
    protected $keyType = 'string';// pour dire que l'id est de type str sinon par defaut c'est un int et impossible d'ajouter un soin

    protected $fillable = ['id_vet', 'nom_vet', 'email'];

    public function soins()
    {
        return $this->hasMany(SoinEntrain::class, 'nom_vet');
    }
}
