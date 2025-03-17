<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participe extends Model
{
    use HasFactory;

    protected $table = 'participe';
    public $timestamps = false;

    //les champs de notre bdd
    protected $fillable = [
        'id_licence', 'id_compet'
    ];

    public function cavalier()
    {
        return $this->belongsTo(Cavalier::class);
    }

    public function competition()
    {
        return $this->belongsTo(Competition::class);
    }
}
