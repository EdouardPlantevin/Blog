<?php

namespace App\Models;

class SuperGlobal {

    public function getServer($key){
        return $_SERVER[$key];
    }

    public function getPost($key) {
        
        return (isset($_POST[$key]) ? $_POST[$key] : null);
    }

    public function getGlobalPost(){
        return $_POST;
    }

    public function getFile()
    {
        return $_FILES;
    }
}