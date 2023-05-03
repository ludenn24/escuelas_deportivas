<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Ollas extends Model
{

    protected $table = 'tb_ollas_excel';

    protected $fillable = [
        'id',
        'correo',
        'distrito',
        'zona',
        'aahh',
        'ubicacion',
        'fecha_creacion',
        'agua',
        'luz',
        'nombre_olla',
        'nombre_contacto',
        'cargo_contacto',
        'celular_contacto',
        'presencia_muni',
        'insumos',
        'org_ayuda',
        'instrumentos',
        'dias_atencion',
        'comidas_dia',
        'raciones',
        'precio_racion',
        'raciones_pagadas',
        'zonas_beneficiadas',
        'familias_beneficiadas',
        'ninos_beneficiadas',
        'adultos_beneficiadas',
        'disca_beneficiadas',
        'emba_beneficiadas',
        'enfercro_beneficiadas',
        'observaciones',
        'total_beneficiadas',
        'foto',
        'latitud',
        'longitud',
        'estado',
        'padrones',
        'comedorpopular',
        'comite',
        'nombre_contacto_secundario',
        'cargo_contacto_secundario',
        'celular_contacto_secundario',
        'tipo_espacio',
        'estado_espacio',
        'combustible',
        'techo',
        'lavado',
        'higiene',
        'huerto',
        'espacio_huerto',
        'liderazgo',
        'inocuidad',
        'extranjera',
        'migrante_atencion',
        'protocolos',
        'otro_cap',
        'fecha_actualizacion_padron',
        'estado_olla_comun',
        'razones_inactividad',
        'cuales_dias_atencion',
        'funcionamiento_ollas',
        'registro_ruos',
        'tipo_registro_ruos',
        'nivel_instruccion',
        'tipo_celular',
        'tipo_techo',
        'tipo_pared',
        'tipo_suelo',
        'botiquin',
        'implementos',
        'poblacion_migrante',
        'atencion_poblacion_mujeres',
        'atencion_poblacion_varones',
        'atencion_poblacion_ninos',
        'involucramiento_migrante',
        'numero_involucramiento_migrante',
        'numero_iniciativas',
        'numero_emprendimientos',
        'numero_idioma_diferente',
        'lenguas',
        'quechua',
        'shipibo',
        'aymara',
        'cual_cap',
        'clasificacion_actividad'
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