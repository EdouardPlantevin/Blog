<?php

namespace App\Controllers;

abstract class Controller 
{
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