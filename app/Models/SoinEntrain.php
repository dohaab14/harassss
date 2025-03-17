<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class SoinEntrain extends Model{

    //apppel de notre vue "vue_soins" créer dans notre BD
    protected $table = 'vue_soins';
    public $timestamps = false;

    //les champs de notre BD
    protected $fillable = [
        'nom_vet', 'date_soin', 'nature_soin', 'nom_cheval'
    ];

}