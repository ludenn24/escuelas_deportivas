<?php

namespace App\Controllers;
use App\Helper\JsonRequest;
use App\Helper\JsonRenderer;
use App\Models\Participantes;
use App\Models\Inscripciones;
use App\Controllers\Controller;
use App\Models\Sedes;
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
        
        $centro = $request->getParam('centro');
        $curcurso = $request->getParam('curso');
        $curhorario = $request->getParam('horario');
        $cursconvo = $request->getParam('horario');

        foreach ($curhorario as $key => $value) { 
            if (isset($value) && !empty($value)) {
                $input['id_participante'] = $lastid;
                $input['id_sede'] = $centro;
                $input['id_horario'] = $curhorario[$key];
                $input['id_convocatoria'] = $curcurso[$key];
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

public function GetViewInscripcionesxSede($request, $response, $args)
{
    try {
        $sede = $args['cod'];
        $data_sede = Sedes::where('id_sede',$sede)->first();
        return $this->view->render($response, 'admin/auth/inscripcionesxsede.twig',[
            'data_sede' => $data_sede
        ]);
    } catch (ErrorException $e) {
        $data = "Hubo un error al listar los datos.";
        return $this->response->withJson($data, 200);
    }
}


public function ListarInscripciones($request, $response, $args) {
    try {
        $sede = $request->getParam('codigo');
        $data = Inscripciones::select('tb_participantes.dni',
        'tb_participantes.nombres',
        'tb_participantes.ape_paterno',
        'tb_participantes.ape_materno',
        'tb_inscripciones.estado',
        'tb_inscripciones.inicio',
        'tb_inscripciones.fin',
        'tb_inscripciones.id_inscripcion',
        'tb_cursos.nombre as nom_curso',
        'tb_cursos.frecuencia',
        'tb_horarios.horario',
        'tb_horarios.edades')
        ->join('tb_participantes', 'tb_inscripciones.id_participante', '=', 'tb_participantes.id_participante')
        ->join('tb_horarios', 'tb_inscripciones.id_horario', '=', 'tb_horarios.id_horario')
        ->join('tb_cursos', 'tb_horarios.id_curso', '=', 'tb_cursos.id_curso')
        ->where('tb_inscripciones.id_sede', $sede)
        ->get();
        $arreglo["data"] = $data;
        return $this->response->withJson($arreglo);
    } catch (ErrorException $e) {
        $data = "Hubo un error al listar los datos.";
        return $this->response->withJson($data, 500);
    }
}

public function Inscripcion($request, $response, $args) {
    try {
        $sede = $request->getParam('codigo');
        $data = Inscripciones::select('tb_participantes.dni',
        'tb_participantes.nombres',
        'tb_participantes.ape_paterno',
        'tb_participantes.ape_materno',
        'tb_participantes.fecha_nac',
        'tb_participantes.tipo_documento',
        'tb_participantes.dni',
        'tb_participantes.edad',
        'tb_participantes.condicion_medica',
        'tb_inscripciones.estado',
        'tb_inscripciones.inicio',
        'tb_inscripciones.fin',
        'tb_inscripciones.recibo',
        'tb_inscripciones.id_inscripcion',
        'tb_cursos.nombre as nom_curso',
        'tb_cursos.frecuencia',
        'tb_horarios.horario',
        'tb_horarios.edades')
        ->join('tb_participantes', 'tb_inscripciones.id_participante', '=', 'tb_participantes.id_participante')
        ->join('tb_horarios', 'tb_inscripciones.id_horario', '=', 'tb_horarios.id_horario')
        ->join('tb_cursos', 'tb_horarios.id_curso', '=', 'tb_cursos.id_curso')
        ->where('tb_inscripciones.id_inscripcion', $sede)
        ->get();
         return $this->response->withJson($data, 200);
    } catch (ErrorException $e) {
        $data = "Hubo un error al listar los datos.";
        return $this->response->withJson($data, 500);
    }
}

public function ProcesarInscripcion($request, $response, $args) {
        $codigo = $request->getParam('codigo');
        Inscripciones::where('id_inscripcion', '=', $codigo)->update([
            'inicio' => $request->getParam('inicio'),
            'fin' => $request->getParam('fin'),
            'recibo' => $request->getParam('recibo'),
            'estado' => $request->getParam('estado'),
        ]);
        $mensaje['response'] = 'success';
        $mensaje['message'] = 'Registro guardado';
        echo json_encode($mensaje);
    }

}
