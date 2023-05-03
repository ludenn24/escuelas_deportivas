<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class CasasComunales extends Model
{
    protected $table = 'tb_casas_comunales';

    protected $fillable = [
                            'codigo',
                            'distrito',
                            'nombre_casa',
                            'latitud',
                            'longitud',
                            'estado'
    ];

    public function getDatepublicationAttribute() {
        return Carbon::parse($this->created_at)->format('d/m/Y') ;
    }

    public function getDateSpanishAttribute() {

        $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
        $fecha = Carbon::parse($this->created_at);
        $mes = $meses[($fecha->format('n')) - 1];
        return $fecha->format('d') . ' de ' . $mes . ' de ' . $fecha->format('Y');
    }

}