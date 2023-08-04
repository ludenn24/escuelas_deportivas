<?php

namespace App\Controllers;

use App\Helper\JsonRequest;
use App\Helper\JsonRenderer;

use App\Models\Sedes;
use App\Controllers\Controller;
use Illuminate\Database\Capsule\Manager as DB;
use Respect\Validation\Validator as v;



Class SedesController extends Controller
{
    public function getSedes()
    {
        return Sedes::select('tb_sedes.*','tb_distritos.distrito as nom_distrito')
        ->join('tb_distritos','tb_sedes.distrito','=','tb_distritos.codigo')
        ->get();
    }

    public function ListarSedes($request, $response, $args) {
        try {
            $data = Sedes::select('tb_sedes.*','tb_distritos.distrito as nom_distrito')
            ->join('tb_distritos','tb_sedes.distrito','=','tb_distritos.codigo')
            ->get();
            $arreglo["data"] = $data;
            return $this->response->withJson($arreglo);
        } catch (ErrorException $e) {
            $data = "Hubo un error al listar los datos.";
            return $this->response->withJson($data, 500);
        }
    }

    public function ListarSedesXAdministrador($request, $response, $args) {
        try {
            $sede = $request->getParam('codigo');
            $data = Sedes::select('tb_sedes.*','tb_distritos.distrito as nom_distrito')
            ->join('tb_distritos','tb_sedes.distrito','=','tb_distritos.codigo')
            ->where('tb_sedes.id_sede', $sede)
            ->get();
            $arreglo["data"] = $data;
            return $this->response->withJson($arreglo);
        } catch (ErrorException $e) {
            $data = "Hubo un error al listar los datos.";
            return $this->response->withJson($data, 500);
        }
    }

    public function EditarSedes($request, $response, $args)
    {
        try {
            $id = $request->getParam('codigo');
            $data = Sedes::where('id_sede','=',$id)->get();
            return $this->response->withJson($data, 200);

        } catch (ErrorException $e) {
            $data = "Hubo un error al listar los datos.";
            return $this->response->withJson($data, 200);
        }

    }


    public function RegistrarSedes($request, $response, $args) {
        $carpeta = "uploads/centros_deportivos/";
        $nombre = basename($_FILES["foto"]["name"]);
        $fecha_actual = date('Y-m-d-H-i-s');
        $src = $carpeta . $fecha_actual . '_' . $nombre;
        $tipo = basename($_FILES["foto"]["type"]);
        $size = basename($_FILES["foto"]["size"]);
        $moveee = $_FILES["foto"]["tmp_name"];

        $codigo = $request->getParam('codigo');

        if ($codigo) {
            if ($nombre) {
                if ($size >= 262144000) {
                    $mensaje['response'] = 'error';
                    $mensaje['message'] = 'Solo se permiten subir imágenes de menos de 25 Megabytes.';
                } elseif (move_uploaded_file($moveee, $src)) {
                    Sedes::where('id_sede', '=', $codigo)->update([
                        'nombre' => $request->getParam('nombre'),
                        'distrito' => $request->getParam('distrito'),
                        'direccion' => $request->getParam('direccion'),
                        'estado' => $request->getParam('estado'),
                        'foto' => $src,
                    ]);
                    $mensaje['response'] = 'success';
                    $mensaje['message'] = 'Registro guardado';
                }
                } else {
                    Sedes::where('id_sede', '=', $codigo)->update([
                        'nombre' => $request->getParam('nombre'),
                        'distrito' => $request->getParam('distrito'),
                        'direccion' => $request->getParam('direccion'),
                        'estado' => $request->getParam('estado'),
                ]);
                $mensaje['response'] = 'success';
                $mensaje['message'] = 'Registro guardado';
            }
        } else {

            if ($size >= 262144000) {
                $mensaje['response'] = 'error';
                $mensaje['message'] = 'Solo se permiten subir imágenes de menos de 25 Megabytes.';
            } elseif (move_uploaded_file($moveee, $src)) {
                    Sedes::create([
                        'nombre' => $request->getParam('nombre'),
                        'distrito' => $request->getParam('distrito'),
                        'direccion' => $request->getParam('direccion'),
                        'estado' => $request->getParam('estado'),
                        'foto' => $src,
                    ]);
                    $mensaje['response'] = 'success';
                    $mensaje['message'] = 'Registro guardado';
            }
        }
        echo json_encode($mensaje);
    }

}
