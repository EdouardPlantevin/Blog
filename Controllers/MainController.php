<?php

namespace App\Controllers;

use App\Models\Server;
use App\Models\Session;

class MainController extends Controller
{
    public function index()
    {
        $server = new Server;
        $url = "/{$server::get('HTTP_HOST')}{$server::get('REQUEST_URI')}";

        if($url == "/localhost:8888/BDDPHP/public/")
        {
            header('Location: ' . '/Blog/public/');
        }

        $this->render('main/index', [
            'session' => new Session
        ]);
    }
}