<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cheval extends Model
{
    //appel de ma table cheval dans la BD
    protected $table = 'cheval'; 
    protected $primaryKey = 'id_cheval';
    //ajout des champs de ma BD
    protected $fillable = ['id_cheval', 'nom_cheval', 'race', 'date_naissance', 'sexe_chev']; 

    /**
     * relations avec les autres modeles (explication dans Cavalier.php)
     * utile pour l'affichage des informations sur mon tableau surtout que les tables n'ont pas forcement un lien direct entre elles 
     */
    public function soinsEn()
    {
        return $this->hasMany(SoinEntrain::class, 'nom_cheval');
    }
    public function soinsVet()
    {
        return $this->hasMany(SoinVet::class, 'id_cheval');
    }
    public function palmares()
    {
        return $this->hasMany(Palmares::class, 'id_cheval');
    }
}
