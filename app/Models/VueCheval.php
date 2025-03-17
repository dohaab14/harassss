<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VueCheval extends Model
{
    use HasFactory;

    protected $table = 'vue_chev';
    protected $fillable = [
        'nom_cheval', 'race', 'date_naissance', 'nom_club'
    ];

    public function entraineur()
    {
        return $this->belongsToMany(Entraineur::class, 'entraine', 'id_cheval', 'id_entraineur');
    }

    public function soins()
    {
        return $this->hasMany(SoinVet::class, 'id_cheval');
    }

    public function palmares()
    {
        return $this->hasMany(Palmares::class, 'id_cheval');
    }
}
