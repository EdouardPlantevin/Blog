<?php

use App\Autoloader;
use App\Core\Main;

require '/Applications/MAMP/htdocs/Blog/Autoloader.php';
Autoloader::register();

$app = new Main();
$app->start();

