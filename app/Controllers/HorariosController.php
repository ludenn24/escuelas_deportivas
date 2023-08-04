<?php
namespace App\Controllers;
use App\Helper\JsonRequest;
use App\Helper\JsonRenderer;
use App\Models\Horarios;
use App\Controllers\Controller;
use Illuminate\Database\Capsule\Manager as DB;
use Respect\Validation\Validator as v;

Class HorariosController extends Controller
{
    //CURSOS 
    public function GetHorariosPorCursos($request, $response, $args)
    {
        try {
            $curso = $request->getParam('curso');
            $data = Horarios::where('id_curso',$curso)->get();
            return $this->response->withJson($data, 200);
        } catch (ErrorException $e) {
            $data = "Hubo un error al listar los datos.";
            return $this->response->withJson($data, 200);
        }
    }

    //ADMIN 
    public function GetHorarios($request, $response, $args)
    {
        try {
            $curso = $request->getParam('curso');
            $data = Horarios::where('id_curso',$curso)->get(); 
            $arreglo["data"] = $data;
            return $this->response->withJson($arreglo);
        } catch (ErrorException $e) {
            $data = "Hubo un error al listar los datos.";
            return $this->response->withJson($data, 200);
        }
    }

    public function EditarHorario($request, $response, $args)
    {
        try {
            $id = $request->getParam('codigo');
            $data = Horarios::where('id_horario','=',$id)->get();
            return $this->response->withJson($data, 200);
        } catch (ErrorException $e) {
            $data = "Hubo un error al listar los datos.";
            return $this->response->withJson($data, 200);
        }
    }

    public function Registrar($request, $response, $args) {
        $codigo = $request->getParam('codigo');
        if ($codigo) {
                 Horarios::where('id_horario', '=', $codigo)->update([
                    'id_curso' => $request->getParam('cod_curso'),
                    'horario' => $request->getParam('horario'),
                    'edades' => $request->getParam('edades'),
                    'estado' => $request->getParam('estado_horario'),
                ]);
                $mensaje['response'] = 'success';
                $mensaje['message'] = 'Registro actualizado';
        } else {
                Horarios::create([
                    'id_curso' => $request->getParam('cod_curso'),
                    'horario' => $request->getParam('horario'),
                    'edades' => $request->getParam('edades'),
                    'estado' => $request->getParam('estado_horario'),
                ]);
                $mensaje['response'] = 'success';
                $mensaje['message'] = 'Registro guardado';         
        }
        echo json_encode($mensaje);
    }


}
