<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class SoinVet extends Model{

    //apppel de notre vue "vue_soins" créer dans notre BDD
    protected $table = 'soin_veterinaire';
    protected $primaryKey = 'id_soin';
    //eviter que dans la bdd j'ai la date de moditication 
    public $timestamps = false;

    //les champs de notre bdd
    protected $fillable = [
        'id_soin', 'id_vet', 'nom_vet', 'email', 'date_soin', 'nature_soin', 'id_cheval', 'nom_cheval', 'race', 'date_naissance', 'sexe_chev'
    ];
    public function veterinaire()
    {
        return $this->belongsTo(Veterinaire::class,  'id_vet');
    }

    public function cheval()
    {
        return $this->belongsTo(Cheval::class, 'id_cheval');
    }

}