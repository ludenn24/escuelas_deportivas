<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class OllasFiltradas extends Model
{

    protected $table = 'tb_ollas_filtradas';
    
    protected $fillable = [
        'id',
        'distrito',
        'tipo_lima',
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
        'presencia_municipal',
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
        'otro_cap'
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