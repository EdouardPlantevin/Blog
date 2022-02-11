<?php

namespace App\Controllers;

use App\Models\ArticleModel;

class MainController extends Controller
{
    public function index()
    {
        $url = "/{$this->superGlobal()->getServer('HTTP_HOST')}{$this->superGlobal()->getServer('REQUEST_URI')}";

        if($url == "/localhost:8888/Blog/public/")
        {
            $this->redirectToRoute('/Blog/public/edouard-plantevin');
        }

        $articlesModel = new ArticleModel;

        $articles = $articlesModel->findBy(['active' => 1]);

        $this->render('main/index', [
            'articles' => $articles,
            'session' => $this->session()
        ]);
    }
}