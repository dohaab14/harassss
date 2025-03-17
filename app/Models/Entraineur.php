<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entraineur extends Model
{
    use HasFactory;

    protected $table = 'entraineur';

    protected $primaryKey = 'id_entraineur';

    protected $fillable = ['nom_club'];
    public function chevaux()
    {
        return $this->belongsToMany(Cheval::class, 'entraine', 'id_entraineur', 'id_cheval');
    }
}
