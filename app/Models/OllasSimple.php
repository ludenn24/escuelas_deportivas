<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class OllasSimple extends Model
{

    protected $table = 'tb_ollas_simple';
    
    protected $fillable = [
        'codigo',
        'distrito',
        'nombre_olla',
        'nombre_contacto',
        'celular_contacto',
        'raciones'
    ];

    
}