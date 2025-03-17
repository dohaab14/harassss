<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ville extends Model
{
    use HasFactory;

    protected $table = 'ville';

    protected $primaryKey = 'id_ville';

    protected $fillable = ['nom_ville']; 

    public function competitions()
    {
        return $this->hasMany(Competition::class, 'id_ville');
    }
}
