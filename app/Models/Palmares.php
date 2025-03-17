<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Palmares extends Model
{
    use HasFactory;

    protected $table = 'palmares';
    protected $primaryKey = 'id_palmares';

    protected $fillable = ['rang', 'id_cheval', 'id_compet'];

    public function cheval()
    {
        return $this->belongsTo(Cheval::class, 'id_cheval');
    }

    public function competition()
    {
        return $this->belongsTo(Competition::class, 'id_compet');
    }
}
