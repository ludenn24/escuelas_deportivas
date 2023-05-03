<?php

namespace App\Controllers;

use App\Helper\JsonRequest;
use App\Helper\JsonRenderer;

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
}
