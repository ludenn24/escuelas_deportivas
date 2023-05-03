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
}
