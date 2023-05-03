<?php

namespace App\Models;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
class ReporteAtendidas extends Model
{
    protected $table = 'tb_reporte_atendidas';
    protected $fillable = [
        'id',
        'distrito',
        'limas',
        'ollas_registradas',
        'ollas_atendidas',
        'raciones',
        'estado'
    ];
}