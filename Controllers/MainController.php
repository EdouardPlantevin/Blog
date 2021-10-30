<?php

namespace App\Controllers;

class MainController extends Controller
{
    public function index()
    {
        $url =  "/{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";

        if($url == "/localhost:8888/BDDPHP/public/")
        {
            header('Location: ' . PATH);
        }

        $this->render('main/index');
    }
}