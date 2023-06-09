<?php
use Respect\Validation\Validator as v;
use Slim\Http\UploadedFile;

session_start();

require __DIR__ . '/../vendor/autoload.php';


$settings = require 'settings.php';
$app = new \Slim\App($settings);

$container = $app->getContainer();

$capsule = new \Illuminate\Database\Capsule\Manager;
$capsule->addConnection($container['settings']['db']);
$capsule->setAsGlobal();
$capsule->bootEloquent();

$container['db'] = function ($container) use ($capsule) {
    return $capsule;
};

$container['flash'] = function ($container) {
    return new \Slim\Flash\Messages;
};
    
$container['view'] = function ($container){
    $view = new \Slim\Views\Twig(__DIR__ . '/../resources/views',[
        'cache' => false,
    ]);

    $view->addExtension(new \Slim\Views\TwigExtension(
        $container->router,
        $container->request->getUri()
    ));

    $view->getEnvironment()->addGlobal('SedesController', [
        'sedes' => $container->SedesController->getSedes(),
    ]);

    return $view;
};


$container['HomeController'] = function ($container) {
    return new \App\Controllers\HomeController($container);
};

$container['OllasController'] = function ($container) {
    return new \App\Controllers\OllasController($container);
};

$container['AdminController'] = function ($container) {
    return new \App\Controllers\AdminController($container);
};

$container['AuthController'] = function ($container) {
    return new \App\Controllers\AuthController($container);
};

$container['MenuCategoriaController'] = function ($container) {
    return new \App\Controllers\MenuCategoriaController($container);
};

$container['MenuItemController'] = function ($container) {
    return new \App\Controllers\MenuItemController($container);
};

$container['ExportController'] = function ($container) {
    return new \App\Controllers\ExportController($container);
};

$container['EntradaController'] = function ($container) {
    return new \App\Controllers\EntradaController($container);
};

$container['EstadisticasController'] = function ($container) {
    return new \App\Controllers\EstadisticasController($container);
};

$container['SedesController'] = function ($container) {
    return new \App\Controllers\SedesController($container);
};

$container['CursosController'] = function ($container) {
    return new \App\Controllers\CursosController($container);
};

$container['ParticipantesController'] = function ($container) {
    return new \App\Controllers\ParticipantesController($container);
};

$container['HorariosController'] = function ($container) {
    return new \App\Controllers\HorariosController($container);
};

$container['csrf'] = function ($container) {
    // return new \Slim\Csrf\Guard;
    $guard = new \Slim\Csrf\Guard();
    $guard->setPersistentTokenMode(true);
    return $guard;
};

$app->add(new \App\Middleware\ValidationErrorsMiddleware($container));
$app->add(new \App\Middleware\OldInputMiddleware($container));
$app->add(new \App\Middleware\CsrfViewMiddleware($container));

$app->add($container->csrf);


require __DIR__ . '/../app/routes.php';