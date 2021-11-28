<?php

namespace App\Controllers;

use App\Models\Server;
use App\Models\Session;
use App\Models\SuperGlobal;

class MainController extends Controller
{
    public function index()
    {
        $this->render('main/index', [
            'session' => new Session
        ]);
    }
}