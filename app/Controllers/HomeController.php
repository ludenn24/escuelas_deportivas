<?php

namespace App\Controllers;
use App\Models\Ollas;
use Slim\Views\Twig as View;

Class  HomeController extends Controller
{

    public function index($request, $response)
    {
        return $this->view->render($response, 'home.twig');
    }
    
}
