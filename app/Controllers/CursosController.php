<?php

namespace App\Controllers;

use App\Helper\JsonRequest;
use App\Helper\JsonRenderer;
use App\Models\Sedes;
use App\Models\Cursos;
use App\Controllers\Controller;
use Illuminate\Database\Capsule\Manager as DB;
use Respect\Validation\Validator as v;

Class CursosController extends Controller
{
    //CURSOS 
    public function GetCursosPorSedes($request, $response, $args)
    {
        try {
            $sede = $request->getParam('sede');
            $data = Cursos::where('id_sede',$sede)->get();
            return $this->response->withJson($data, 200);
        } catch (ErrorException $e) {
            $data = "Hubo un error al listar los datos.";
            return $this->response->withJson($data, 200);
        }
    }

    public function GetViewCursoxSede($request, $response, $args)
    {
        try {
            $sede = $args['cod'];
            $data_sede = Sedes::where('id_sede',$sede)->first();
            $data_cursos = Cursos::where('id_sede',$sede)->where('estado','!=',3)->get();
            return $this->view->render($response, 'admin/auth/cursosxsede.twig',[
                'data_sede' => $data_sede,
                'data_cursos' => $data_cursos,
            ]);
        } catch (ErrorException $e) {
            $data = "Hubo un error al listar los datos.";
            return $this->response->withJson($data, 200);
        }
    }

    public function EditarCursos($request, $response, $args)
    {
        try {
            $id = $request->getParam('codigo');
            $data = Cursos::where('id_curso','=',$id)->get();
            return $this->response->withJson($data, 200);

        } catch (ErrorException $e) {
            $data = "Hubo un error al listar los datos.";
            return $this->response->withJson($data, 200);
        }

    }

    public function RegistrarCursos($request, $response, $args) {
        $codigo = $request->getParam('codigo_curso');
        if ($codigo) {
                Cursos::where('id_curso', '=', $codigo)->update([
                        'nombre' => $request->getParam('nombre'),
                        'frecuencia' => $request->getParam('frecuencia'),
						'docente' => $request->getParam('docente'),
                        'cupos' => $request->getParam('cupos'),
                        'estado' => $request->getParam('estado'),
                ]);
                $mensaje['response'] = 'success';
                $mensaje['message'] = 'Registro guardado';
        } else {
                Cursos::create([
                    'id_sede' => $request->getParam('codigo_sede'),
                    'nombre' => $request->getParam('nombre'),
                    'frecuencia' => $request->getParam('frecuencia'),
					'docente' => $request->getParam('docente'),
                    'cupos' => $request->getParam('cupos'),
                    'estado' => $request->getParam('estado'),
                ]);
                $mensaje['response'] = 'success';
                $mensaje['message'] = 'Registro guardado';
        }
        echo json_encode($mensaje);
    }

}
