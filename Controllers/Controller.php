<?php

namespace App\Controllers;

use App\Models\Session;
use App\Models\SuperGlobal;

abstract class Controller 
{

    public function session()
    {
        $session = new Session;
        return $session;
    }

    public function superGlobal()
    {
        $superGlobal = new SuperGlobal;
        return $superGlobal;
    }

    public function render(string $file, array $data = [], string $template = 'default')
    {
        extract($data);

        ob_start();

        require "/Applications/MAMP/htdocs/Blog/Views/$file.php";

        $body = ob_get_clean();

        require "/Applications/MAMP/htdocs/Blog/Views/$template.php";
    }

    public function redirectToRoute($url)
    {
        header("Location: $url");
    }
} 