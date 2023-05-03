<?php
namespace App\Controllers;

use App\Helper\JsonRequest;
use App\Helper\JsonRenderer;
use App\Models\OllasFiltradas;
use App\Controllers\Controller;
use App\Models\ReporteAtendidas;
use Illuminate\Database\Capsule\Manager as DB;
use Respect\Validation\Validator as v;

Class EstadisticasController extends Controller {

    public function getViewGeoMap($request, $response) {
        return $this->view->render($response, 'templates/geomap.twig');
    }

    public function getViewGeoreferencio($request, $response) {
        return $this->view->render($response, 'templates/georeferenciado.twig');
    }

    public function getViewAtendidas($request, $response) {
        return $this->view->render($response, 'templates/atendidas.twig');
    }

    //Cantidad de Ollas comunes atendidas según distritos
    public function PrecioPromedio($request, $response, $args) {
        try {
            $lima = $request->getParam('lima');
            $distrito = $request->getParam('distrito');
            $data = OllasFiltradas::select(DB::raw('tipo_lima as nombre, AVG(foto) as promedio, SUM(total_beneficiadas) as cantidad'))
                ->where(function ($q) use ($lima) {
                    if ($lima) {
                        $q->where('tipo_lima', $lima);
                    }
                })
                ->where(function ($q) use ($distrito) {
                    if ($distrito) {
                        $q->where('distrito', 'like', $distrito);
                    }
                })
                ->GroupBy('tipo_lima')
                ->get();
            return $this->response->withJson($data);
        } catch (ErrorException $e) {
            $data = "Hubo un error al listar los datos.";
            return $this->response->withJson($data);
        }
    }

    //Top 5 de distritos con más ollas georreferenciadas
    public function Top5distritosgeo($request, $response, $args) {
        try {
            $lima = $request->getParam('lima');
            $distrito = $request->getParam('distrito');
            $data = OllasFiltradas::select(DB::raw('distrito as nombre, count(*) as cantidad'))
                ->where(function ($q) use ($lima) {
                    if ($lima) {
                        $q->where('tipo_lima', $lima);
                    }
                })
                ->where(function ($q) use ($distrito) {
                    if ($distrito) {
                        $q->where('distrito', 'like', $distrito);
                    }
                })
                ->GroupBy('distrito')
                ->OrderBy('cantidad','DESC')
                ->take(5)
                ->get();
            return $this->response->withJson($data);
        } catch (ErrorException $e) {
            $data = "Hubo un error al listar los datos.";
            return $this->response->withJson($data);
        }
    }

    //Top 5 de distritos con más ollas atendidas
    public function ollasregistradaspordistrito($request, $response, $args) {
        try {
            $data = DB::select('SELECT distrito as nombre, count(distrito) cantidad 
                                    FROM tb_ollas_filtradas
                                    GROUP by distrito
									ORDER BY cantidad DESC;');
            return $this->response->withJson($data);
        } catch (ErrorException $e) {
            $data = "Hubo un error al listar los datos.";
            return $this->response->withJson($data);
        }
    }

    //Top 5 de distritos con más ollas atendidas
    public function top5distritos($request, $response, $args) {
        try {
            $data = OllasFiltradas::select(DB::raw('distrito as nombre, count(*) as cantidad'))
                ->where('presencia_municipal','=', 'Sí')
                ->GroupBy('distrito')
                ->OrderBy('cantidad','DESC')
                ->take(5)
                ->get();
            return $this->response->withJson($data);
        } catch (ErrorException $e) {
            $data = "Hubo un error al listar los datos.";
            return $this->response->withJson($data);
        }
    }

    //Top 5 de distritos con más ollas atendidas
    public function top5distritosatendidos($request, $response, $args)
    {
        try {
            $lima = $request->getParam('lima');
            $distrito = $request->getParam('distrito');
            $data = ReporteAtendidas::select('distrito', 'ollas_atendidas')
                ->where(function ($q) use ($lima) {
                    if ($lima) {
                        $q->where('limas', $lima);
                    }
                })
                ->where(function ($q) use ($distrito) {
                    if ($distrito) {
                        $q->where('distrito', 'like', $distrito);
                    }
                })
                ->take(5)
                ->get();
            return $this->response->withJson($data);
        } catch (ErrorException $e) {
            $data = "Hubo un error al listar los datos.";
            return $this->response->withJson($data);
        }
    }

    //Cantidad de Ollas comunes atendidas según distritos
    public function AccesoAgua($request, $response, $args) {
        try {
            $lima = $request->getParam('lima');
            $distrito = $request->getParam('distrito');
            $data = OllasFiltradas::select(DB::raw('instrumentos as nombre, count(*) as cantidad'))
                ->where(function ($q) use ($lima) {
                    if ($lima) {
                        $q->where('tipo_lima', $lima);
                    }
                })
                ->where(function ($q) use ($distrito) {
                    if ($distrito) {
                        $q->where('distrito', 'like', $distrito);
                    }
                })
                ->GroupBy('instrumentos')
                ->OrderBy('cantidad','DESC')
                ->get();
            return $this->response->withJson($data);
        } catch (ErrorException $e) {
            $data = "Hubo un error al listar los datos.";
            return $this->response->withJson($data);
        }
    }

    //Cantidad de Ollas comunes atendidas según distritos
    public function AccesoLuz($request, $response, $args) {
        try {
            $lima = $request->getParam('lima');
            $distrito = $request->getParam('distrito');
            $data = OllasFiltradas::select(DB::raw('dias_atencion as nombre, count(*) as cantidad'))
                ->where(function ($q) use ($lima) {
                    if ($lima) {
                        $q->where('tipo_lima', $lima);
                    }
                })
                ->where(function ($q) use ($distrito) {
                    if ($distrito) {
                        $q->where('distrito', 'like', $distrito);
                    }
                })
                ->GroupBy('dias_atencion')
                ->OrderBy('cantidad','DESC')
                ->get();
            return $this->response->withJson($data);
        } catch (ErrorException $e) {
            $data = "Hubo un error al listar los datos.";
            return $this->response->withJson($data);
        }
    }

    //Cantidad de Ollas comunes atendidas según distritos
    public function Beneficiarios($request, $response, $args) {
        try {
            $lima = $request->getParam('lima');
            $distrito = $request->getParam('distrito');
            $data = OllasFiltradas::select(DB::raw('
            SUM(comedorpopular) as ninos,
            SUM(comite) as adultomayor,
            SUM(nombre_contacto_secundario) as discapacitados,
            SUM(celular_contacto_secundario) as enfermedades'))
            ->where(function ($q) use ($lima) {
                if ($lima) {
                    $q->where('tipo_lima', $lima);
                }
            })
            ->where(function ($q) use ($distrito) {
                if ($distrito) {
                    $q->where('distrito', 'like', $distrito);
                }
            })
            ->first();
            $comp = [
                [
                    'total' => $data->ninos,
                    'categoria' => "Niños",
                ],
                [
                    'total' => $data->adultomayor,
                    'categoria' => "Adulto mayor",
                ],
                [
                    'total' => $data->discapacitados,
                    'categoria' => "Discapacitados",
                ],
                [
                    'total' => $data->enfermedades,
                    'categoria' => "Enfermedades crónicas",
                ]
            ];
            return $this->response->withJson($comp);
        } catch (ErrorException $e) {
            $data = "Hubo un error al listar los datos.";
            return $this->response->withJson($comp);
        }
    }

    //OLLLAS ATENDIDAS

    //Cantidad de Ollas comunes atendidas según distritos
        public function ollasatendidaspordistrito($request, $response, $args) {
        try {
            $lima = $request->getParam('lima');
            $distrito = $request->getParam('distrito');
            $data = ReporteAtendidas::select('distrito as nombre','ollas_atendidas as cantidad')
                ->where(function ($q) use($lima) {
                    if ($lima) {
                        $q->where('limas', $lima);
                    }
                })
                ->where(function ($q) use($distrito) {
                    if ($distrito) {
                        $q->where('distrito', 'like', $distrito);
                    }
                })
                ->OrderBy('ollas_atendidas','DESC')
                ->get();
            return $this->response->withJson($data);
        } catch (ErrorException $e) {
            $data = "Hubo un error al listar los datos.";
            return $this->response->withJson($data);
        }
    }

    //Cantidad de Ollas comunes atendidas según distritos
    public function ollasatendidas($request, $response, $args) {
        try {
            $data = OllasFiltradas::select(DB::raw('otro_cap,
            count(*) as ollas,
            count(DISTINCT  distrito) as distritos,
            SUM(tipo_espacio) as beneficiarios,
            SUM(total_beneficiadas) as raciones'))
                ->where('presencia_municipal','=', 'Sí')
                ->GroupBy('otro_cap')
                ->get();
            return $this->response->withJson($data);
        } catch (ErrorException $e) {
            $data = "Hubo un error al listar los datos.";
            return $this->response->withJson($data);
        }
    }

    //Cantidad de Ollas comunes atendidas según distritos
    public function GeneradorMapa($request, $response, $args) {
        try {
            $data = OllasFiltradas::select(DB::raw('distrito as nombre, count(*) as cantidad'))
                ->GroupBy('distrito')
                ->get();
            return $this->response->withJson($data);
        } catch (ErrorException $e) {
            $data = "Hubo un error al listar los datos.";
            return $this->response->withJson($data);
        }
    }

    //Cantidad de Ollas comunes atendidas según distritos
    public function racionespordistrito($request, $response, $args) {
        try {
            $lima = $request->getParam('lima');
            $distrito = $request->getParam('distrito');
            $data = ReporteAtendidas::select('distrito as nombre', 'raciones as cantidad')
                ->where(function ($q) use($lima) {
                    if ($lima) {
                        $q->where('limas', $lima);
                    }
                })
                ->where(function ($q) use($distrito) {
                    if ($distrito) {
                        $q->where('distrito', 'like', $distrito);
                    }
                })
                ->get();
            return $this->response->withJson($data);
        } catch (ErrorException $e) {
            $data = "Hubo un error al listar los datos.";
            return $this->response->withJson($data);
        }
    }

    public function NumOllasAtendidas(){
        return ReporteAtendidas::sum('ollas_atendidas');
    }

    public function NumOllas(){
        return OllasFiltradas::count();
    }

    public function OllasTotalesGeorreferenciadas($request, $response, $args){
        try {
            $lima = $request->getParam('lima');
            $distrito = $request->getParam('distrito');
            $anio = $request->getParam('anio');
            $data = OllasFiltradas::selectRaw('count(*) as total')
                ->where(function ($q) use($lima) {
                    if ($lima) {
                        $q->where('tipo_lima', $lima);
                    }
                })
                ->where(function ($q) use($distrito) {
                    if ($distrito) {
                        $q->where('distrito', 'like', $distrito);
                    }
                })
                ->where(function ($q) use($anio) {
                    if ($anio) {
                        $q->where('otro_cap', 'like', $anio);
                    }
                })
                ->get();
            return $this->response->withJson($data);
        } catch (ErrorException $e) {
            $data = "Hubo un error al listar los datos.";
            return $this->response->withJson($data);
        }
    }

    public function RacionesTotalesGeorreferenciadas($request, $response, $args){
        try {
            $lima = $request->getParam('lima');
            $distrito = $request->getParam('distrito');
            $anio = $request->getParam('anio');
            $data = OllasFiltradas::selectRaw('sum(total_beneficiadas) as total')
                ->where(function ($q) use($lima) {
                    if ($lima) {
                        $q->where('tipo_lima', $lima);
                    }
                })
                ->where(function ($q) use($distrito) {
                    if ($distrito) {
                        $q->where('distrito', 'like', $distrito);
                    }
                })
                ->where(function ($q) use($anio) {
                    if ($anio) {
                        $q->where('otro_cap', 'like', $anio);
                    }
                })
                ->get();
            return $this->response->withJson($data);
        } catch (ErrorException $e) {
            $data = "Hubo un error al listar los datos.";
            return $this->response->withJson($data);
        }
    }

    public function OllasTotalesAtendidas($request, $response, $args) {
        try {
            $lima = $request->getParam('lima');
            $distrito = $request->getParam('distrito');
            $data = ReporteAtendidas::selectRaw('sum(ollas_atendidas) as total')
                ->where(function ($q) use($lima) {
                    if ($lima) {
                        $q->where('limas', $lima);
                    }
                })
                ->where(function ($q) use($distrito) {
                    if ($distrito) {
                        $q->where('distrito', 'like', $distrito);
                    }
                })
                ->get();
            return $this->response->withJson($data);
        } catch (ErrorException $e) {
            $data = "Hubo un error al listar los datos.";
            return $this->response->withJson($data);
        }
    }

    public function RacionesTotalesAtendidas($request, $response, $args) {
        try {
            $lima = $request->getParam('lima');
            $distrito = $request->getParam('distrito');
            $data = ReporteAtendidas::selectRaw('sum(raciones) as total')
                ->where(function ($q) use($lima) {
                    if ($lima) {
                        $q->where('limas', $lima);
                    }
                })
                ->where(function ($q) use($distrito) {
                    if ($distrito) {
                        $q->where('distrito', 'like', $distrito);
                    }
                })
                ->get();
            return $this->response->withJson($data);
        } catch (ErrorException $e) {
            $data = "Hubo un error al listar los datos.";
            return $this->response->withJson($data);
        }
    }

}
