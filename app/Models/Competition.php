<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Competition extends Model
{
    use HasFactory;

    protected $table = 'competition';
    protected $primaryKey = 'id_compet';

    protected $fillable = ['nom_compet', 'date_compet', 'categorie', 'id_ville'];

    public function ville()
    {
        return $this->belongsTo(Ville::class, 'id_ville');
    }

    public function palmares()
    {
        return $this->hasMany(Palmares::class, 'id_compet');
    }
}
