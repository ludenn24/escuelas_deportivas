<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Entrada extends Model
{
    protected $table = 'tb_entrada';

    protected $fillable = [
        'codigo',
        'categoria',
        'principal',
        'titulo',
        'detalle',
        'detallecorto',
        'foto',
        'estado',
    ];
}
