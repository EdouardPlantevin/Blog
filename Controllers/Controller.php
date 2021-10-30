<?php

namespace App\Controllers;

abstract class Controller 
{
    public function render(string $file, array $data = [], string $template = 'default')
    {
        extract($data);

        ob_start();

        $root = dirname(__DIR__);

        require_once "$root/Views/$file.php";

        $body = ob_get_clean();

        require_once "$root/Views/$template.php";
    }
} 