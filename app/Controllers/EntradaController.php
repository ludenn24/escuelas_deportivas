<?php

namespace App\Controllers;

use App\Models\Entrada;
use App\Controllers\Controller;
use Psr\Http\Message\ServerRequestInterface as Request;
use Respect\Validation\Validator as v;
use Illuminate\Database\Capsule\Manager as DB;

Class EntradaController extends Controller {

       public function  getViewEntrada($request, $response, $args) {
        $codigo = $args['cod'];
        $entrada = Entrada::where('codigo', '=', $codigo)->first();
        $recientes = Entrada::select(DB::raw('DATE_FORMAT(created_at, "%d-%b-%Y") as formated'), 'tb_entrada.*')->where('tb_entrada.codigo', '=', $codigo)->get();
        
        return $this->view->render($response, 'templates/entrada.twig',[
            'entrada' => $entrada,
            'recientes' => $recientes,
        ]);
    }
    
    public function Registrar($request, $response, $args) {
        $carpeta = "uploads/materiales/";
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
                    Entrada::where('codigo', '=', $codigo)->update([
                        'categoria' => $request->getParam('categoria'),
                        'principal' => $request->getParam('principal'),
                        'titulo' => $request->getParam('titulo'),
                        'detallecorto' => $request->getParam('detallecorto'),
                        'detalle' => $request->getParam('detalle'),
                        'estado' => $request->getParam('estado'),
                        'foto' => $src,
                    ]);
                    $mensaje['response'] = 'success';
                    $mensaje['message'] = 'Registro guardado';
                }
            } else {
                Entrada::where('codigo', '=', $codigo)->update([
                    'categoria' => $request->getParam('categoria'),
                    'principal' => $request->getParam('principal'),
                    'titulo' => $request->getParam('titulo'),
                    'detallecorto' => $request->getParam('detallecorto'),
                    'detalle' => $request->getParam('detalle'),
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
                Entrada::create([
                    'categoria' => $request->getParam('categoria'),
                    'principal' => $request->getParam('principal'),
                    'titulo' => $request->getParam('titulo'),
                    'detallecorto' => $request->getParam('detallecorto'),
                    'detalle' => $request->getParam('detalle'),
                    'foto' => $src,
                ]);
                $mensaje['response'] = 'success';
                $mensaje['message'] = 'Registro guardado';
            }
        }
        echo json_encode($mensaje);
    }

    public function Listar($request, $response, $args) {
        try {
            $categoria = $request->getParam('categoria');
            $data = Entrada::where('categoria', '=', $categoria)
                    ->where('estado', '!=', 3)
                    ->orderBy('created_at', 'DESC')->get();
            $arreglo["data"] = $data;
            return $this->response->withJson($arreglo);
        } catch (ErrorException $e) {
            $data = "Hubo un error al listar los datos.";
            return $this->response->withJson($data, 500);
        }
    }

        public function getEntrada($request, $response, $args) {
            try {
                $codigo = $request->getParam('codigo');
                $data = Entrada::where('codigo', '=', $codigo)->get();
                return $this->response->withJson($data, 200);
            } catch (ErrorException $e) {
                $data = "Hubo un error al listar los datos.";
                return $this->response->withJson($data, 200);
            }
        }
        
        public function NoticiaDetalle($request, $response, $args)
        {
        $codigo = $args['cod'];
        $noticia = Entrada::where('codigo', $codigo)->first();
        return $this->view->render($response, 'templates/detalle-noticia.twig',[
            'noticia' => $noticia,
        ]);

        }

       public function listaReportes()
        {
            return Entrada::where('categoria', 'reportes')->where('estado', '1')->get();
        }
        
        
            public function listaDatos()
        {
            return Entrada::where('categoria', 'datos')->where('estado', '1')->get();
        }
        
        
        public function listaDocumentos()
        {
            return Entrada::where('categoria', 'documentos')->where('estado', '1')->get();
        }
        
        public function listaNoticias()
        {
            return Entrada::where('categoria', 'noticias')->where('estado', '1')->get();
        }
        
        public function listaNuevas()
        {
            return Entrada::where('categoria', 'nuevas')->where('estado', '1')->get();
        }


    
}
