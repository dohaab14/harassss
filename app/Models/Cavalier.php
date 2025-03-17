<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cavalier extends Model
{
    use HasFactory;

    protected $table = 'cavalier';
    public $timestamps = false;

    protected $fillable = [
        'id_licence', 'nom_caval', 'prenom_caval'
    ];

    //creations de liens car ça permet de recuperer facilement nos donnees sans forcement ecrire de longues requetes
    //et aussi ça permet d'eviter d'avoir des elements manquant dans mon affichage
    public function user()
    {
        return $this->belongsTo(User::class, 'id_licence', 'id_licence');
    }

    //avoir toutes les participations d'un cavalier
    public function participations()
    {
        return $this->hasMany(Participe::class, 'cavalier_id'); // Un cavalier peut avoir plusieurs participations
    }

    //recupere les competitions auxquelles un cavalier a participe
    public function competitions()
    {
        return $this->belongsToMany(Competition::class, 'participe', 'cavalier_id', 'competition_id');
    }
}
