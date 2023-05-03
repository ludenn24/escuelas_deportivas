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
        return Sedes::get();
    }

}
