<?php
use App\Middleware\AuthMiddleware;
use App\Middleware\GuestMiddleware;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
$app->get('/', 'HomeController:index')->setName('home');
$app->get('/registro', 'HomeController:getViewRegistro')->setName('registro');
$app->get('/escuelas-deportivas', 'HomeController:getViewEscuelas')->setName('escuelas');

$app->get('/en', 'HomeController:english')->setName('english');
$app->get('/casas', 'HomeController:casas')->setName('casas');
$app->get('/listaollas', 'OllasController:getListOllas');
$app->get('/listacasas', 'OllasController:getListCasasComunales');
$app->get('/ollas', 'HomeController:index')->setName('home');


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
    $this->get('/sedes', 'AdminController:getViewSedes')->setName('admin.sedes');
    $this->get('/listar/sedes', 'SedesController:ListarSedes')->setName('admin.sedes');
    $this->get('/editar/sedes', 'SedesController:EditarSedes');
    $this->post('/registrar/sedes', 'SedesController:RegistrarSedes');

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

    $this->get('/disciplinas/{cod}', 'CursosController:GetViewCursoxSede');
    $this->get('/horarios/listar', 'HorariosController:GetHorarios');
    $this->get('/horarios/editar', 'HorariosController:EditarHorario');
    $this->post('/horarios/registrar', 'HorariosController:Registrar');

    $this->get('/inscripciones', 'AdminController:getViewInscripciones')->setName('admin.inscripciones');
    $this->get('/participantes', 'AdminController:getViewParticipantes')->setName('admin.participantes');
    $this->get('/listar/sede/admnistrador', 'SedesController:ListarSedesXAdministrador')->setName('admin.sedes_administrador');
    
    $this->get('/inscripciones/{cod}', 'ParticipantesController:GetViewInscripcionesxSede');
    $this->get('/inscripciones/listar/', 'ParticipantesController:ListarInscripciones');
    $this->get('/inscripcion/editar', 'ParticipantesController:Inscripcion');
    $this->post('/inscripcion/procesar', 'ParticipantesController:ProcesarInscripcion');

    $this->get('/curso/editar', 'CursosController:EditarCursos');
    $this->post('/curso/registrar', 'CursosController:RegistrarCursos');

})->add(new AuthMiddleware($container));