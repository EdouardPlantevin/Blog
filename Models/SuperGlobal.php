<?php

namespace App\Models;

class SuperGlobal {

    public static function getServer($key){
        return $_SERVER[$key];
    }

    public static function getPost($key) {
        
        return (isset($_POST[$key]) ? $_POST[$key] : null);
    }

    public static function getGlobalPost(){
        return $_POST;
    }
}