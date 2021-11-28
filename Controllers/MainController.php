<?php

namespace App\Controllers;

use App\Models\Server;
use App\Models\Session;
use App\Models\SuperGlobal;

class MainController extends Controller
{
    public function index()
    {
        $server = new SuperGlobal;
        $url = "/{$server::getServer('HTTP_HOST')}{$server::getServer('REQUEST_URI')}";

        if($url == "/localhost:8888/BDDPHP/public/")
        {
            header('Location: ' . '/Blog/public/');
        }

        $this->render('main/index', [
            'session' => new Session
        ]);
    }
}