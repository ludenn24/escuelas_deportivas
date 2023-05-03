<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Participantes extends Model
{

    protected $table = 'tb_participantes';

    protected $fillable = [
        'id_participante',
        'nombres',
        'ape_paterno',
        'ape_materno',
        'fecha_nac',
        'tipo_documento',
        'dni',
        'edad',
        'grado_estudios',
        'nacionalidad',
        'sexo',
        'condicion_medica',
        'seguro_medico',
        'domicilio',
        'distrito',
        'nombres_apo',
        'nombres_apo',
        'ape_pater_apo',
        'ape_mater_apo',
        'tipo_doc_apo',
        'dni_apo',
        'parentesco',
        'celular_apo',
        'conadis',
        'carne_conadis',
        'silla',
        'tipo_discapacidad',
        'estado',
        'created_at',
        'updated_at'

    ];



    public function getDatepublicationAttribute() {
        return Carbon::parse($this->created_at)->format('d/m/Y') ;
    }

    public function getDateSpanishAttribute() {

        $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
        $fecha = Carbon::parse($this->created_at);
        $mes = $meses[($fecha->format('n')) - 1];
        return $fecha->format('d') . ' de ' . $mes . ' de ' . $fecha->format('Y');

        //return Carbon::parse($this->created_at)->format('d/m/Y') ;
        //  return Carbon::parse($this->created_at)->diffForHumans();
    }

}