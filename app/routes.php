<?php
use App\Middleware\AuthMiddleware;
use App\Middleware\GuestMiddleware;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
$app->get('/', 'HomeController:index')->setName('home');
$app->get('/en', 'HomeController:english')->setName('english');
$app->get('/casas', 'HomeController:casas')->setName('casas');
$app->get('/listaollas', 'OllasController:getListOllas');
$app->get('/listacasas', 'OllasController:getListCasasComunales');
$app->get('/ollas', 'HomeController:index')->setName('home');
//Estadísticas
$app->get('/generadormapa', 'EstadisticasController:GeneradorMapa');
$app->get('/racionestotalesgeorreferenciadas', 'EstadisticasController:RacionesTotalesGeorreferenciadas');
$app->get('/ollastotalesgeorreferenciadas', 'EstadisticasController:OllasTotalesGeorreferenciadas');
$app->get('/ollastotalesatendidas', 'EstadisticasController:OllasTotalesAtendidas');
$app->get('/racionestotalesatendidas', 'EstadisticasController:RacionesTotalesAtendidas');
$app->get('/ollas-estadisticas', 'EstadisticasController:getViewGeoMap')->setName('geomap');
$app->get('/ollas-georeferenciado', 'EstadisticasController:getViewGeoreferencio')->setName('georeferenciado');
$app->get('/ollas-atendidas', 'EstadisticasController:getViewAtendidas')->setName('atendidas');
$app->get('/ollasatendidaspordistrito', 'EstadisticasController:ollasatendidaspordistrito');
$app->get('/ollasatendidas', 'EstadisticasController:ollasatendidas');
$app->get('/top5distritos', 'EstadisticasController:top5distritos');
$app->get('/top5distritosatendidos', 'EstadisticasController:Top5distritosatendidos');
$app->get('/racionespordistrito', 'EstadisticasController:racionespordistrito');
$app->get('/preciopromedio', 'EstadisticasController:PrecioPromedio');
$app->get('/top5distritosgeo', 'EstadisticasController:Top5distritosgeo');
$app->get('/accesoagua', 'EstadisticasController:AccesoAgua');
$app->get('/accesoluz', 'EstadisticasController:AccesoLuz');
$app->get('/beneficiarios', 'EstadisticasController:Beneficiarios');
$app->get('/listaollascasas', 'OllasController:getListOllasCasas');
$app->get('/req-casas', 'OllasController:getViewOllasCasas')->setName('ollascasas');
$app->get('/editar', 'OllasController:getOlla');
$app->post('/actualizar', 'OllasController:Actualizar');
$app->get('/registro', 'OllasController:getViewRegistro')->setName('registro');
$app->post('/registrar', 'OllasController:Registrar');
$app->get('/registro-simple', 'OllasController:getViewRegistroSimple')->setName('registro-simple');
$app->post('/registrar-simple', 'OllasController:RegistrarSimple');
$app->get('/lista-ollas-export', 'ExportController:ExporActivos');

$app->get('/cursos/sede', 'CursosController:GetCursosPorSedes');
$app->get('/horario/curso', 'HorariosController:GetHorariosPorCursos');

$app->post('/registrarparticipante', 'ParticipantesController:Registrar');

$app->group('', function () {
    $this->get('/admin/auth', 'AdminController:getSignIn')->setName('admin.signin');
    $this->post('/admin/auth', 'AdminController:postSignIn');
})->add(new GuestMiddleware($container));
$app->group('/admin', function () {
    $this->get('/export', 'ExportController:ExporTotal');
    $this->get('/export-des', 'ExportController:ExporDesactivadas');
    $this->get('/export-nuevas', 'ExportController:ExporNuevas');
    $this->get('/export-simple', 'ExportController:ExporSimple');
    $this->get('/export/{cod}', 'ExportController:Export');
    $this->get('/listamenu', 'MenuCategoriaController:getMenuCategory');
    $this->get('/dash', 'AdminController:getViewDash')->setName('admin.dash');
    $this->get('/listaitem', 'MenuItemController:getMenuItem');
    $this->get('/auth/signout', 'AuthController:getSignOut')->setName('auth.signout');
    $this->get('/reportes', 'AdminController:getEntradaReportes')->setName('admin.reportes');
    $this->get('/noticias', 'AdminController:getEntradaNoticias')->setName('admin.noticias');
    $this->get('/nuevas', 'AdminController:getEntradaNuevas')->setName('admin.nuevas');
    $this->get('/documentos', 'AdminController:getEntradaDocumentos')->setName('admin.documentos');
    $this->get('/materiales', 'AdminController:getEntradaDatos')->setName('admin.datos');
    $this->get('/entrada/editar', 'EntradaController:getEntrada');
    $this->get('/entrada/listar', 'EntradaController:Listar');
    $this->post('/entrada/registrar', 'EntradaController:Registrar');
    $this->get('/ollas-comunes', 'AdminController:getOrganizaciones')->setName('admin.organizaciones');
    $this->get('/ollas-comunes-distritales', 'AdminController:getOllasDistritales')->setName('admin.olllasdistritales');
    $this->get('/ollas-comunes-simple', 'AdminController:getOllasSimple')->setName('admin.ollassimple');
    $this->get('/ollas/lista', 'OllasController:Listar');
    $this->get('/ollas/lista-distrital', 'OllasController:ListaDistrital');
    $this->get('/ollas/lista-simple', 'OllasController:ListaSimple');
    $this->post('/organizaciones/registrar', 'ArticuloController:Registrar');
    $this->get('/organizaciones/editar', 'ArticuloController:getArticulo');
    $this->get('/junta/lista', 'OllasController:getMiembro');
    $this->post('/junta/registrar', 'OllasController:RegistrarJunta');
})->add(new AuthMiddleware($container));