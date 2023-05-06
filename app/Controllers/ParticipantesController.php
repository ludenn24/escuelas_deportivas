<?php

namespace App\Controllers;
use App\Helper\JsonRequest;
use App\Helper\JsonRenderer;
use App\Models\Participantes;
use App\Models\Inscripciones;
use App\Controllers\Controller;
use Illuminate\Database\Capsule\Manager as DB;
use Respect\Validation\Validator as v;

Class ParticipantesController extends Controller
{
public function Registrar($request, $response, $args) {
    try {
        $lastid = Participantes::create([
            'nombres'=> $request->getParam('nombres'),
            'ape_paterno'=> $request->getParam('ape_paterno'),
            'ape_materno'=> $request->getParam('ape_materno'),
            'fecha_nac'=> $request->getParam('fecha_nac'),
            'tipo_documento'=> $request->getParam('tipo_documento'),
            'dni'=> $request->getParam('dni'),
            'edad'=> $request->getParam('edad'),
            'grado_estudios'=> $request->getParam('grado_estudios'),
            'nacionalidad'=> $request->getParam('nacionalidad'),
            'sexo'=> $request->getParam('sexo'),
            'condicion_medica'=> $request->getParam('condicion_medica'),
            'seguro_medico'=> $request->getParam('seguro_medico'),
            'domicilio'=> $request->getParam('domicilio'),
            'distrito'=> $request->getParam('distrito'),    
            'nombres_apo'=> $request->getParam('nombres_apo'),
            'ape_pater_apo'=> $request->getParam('ape_pater_apo'),
            'ape_mater_apo'=> $request->getParam('ape_mater_apo'),
            'tipo_doc_apo'=> $request->getParam('tipo_doc_apo'),
            'dni_apo'=> $request->getParam('dni_apo'),
            'parentesco'=> $request->getParam('parentesco'),
            'celular_apo'=> $request->getParam('celular_apo'),
            'conadis'=> $request->getParam('conadis'),
            'carne_conadis'=> $request->getParam('carne_conadis'),
            'silla'=> $request->getParam('silla'),
            'tipo_discapacidad'=> $request->getParam('tipo_discapacidad'),
        ])->id;

        $curcurso = $request->getParam('curso');
        $curhorario = $request->getParam('horario');
        $cursconvo = $request->getParam('horario');

        foreach ($curhorario as $key => $value) { 
            if (isset($value) && !empty($value)) {
                $input['id_participante'] = $lastid;
                $input['id_curso'] = $curhorario[$key];
                $input['id_horario'] = $curhorario[$key];
                $input['id_convocatoria'] = $cursconvo[$key];
                Inscripciones::create($input);
            }
          }

        $mensaje['response'] = 'success';
        $mensaje['message'] = 'Registro correcto';

        echo json_encode($mensaje);

    } catch (ErrorException $e) {
        $mensaje['response'] = "error";
        $mensaje['message'] = 'Ocurrió un error, inténtelo nuevamente';
        echo json_encode($mensaje);
    }
}

}
