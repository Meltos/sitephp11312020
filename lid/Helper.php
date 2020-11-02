<?php
namespace Lid;

class Helper
{
    public function dbg($string){
        echo '<pre>';
        print_r ($string);
        echo '</pre>';
    }

    public function GetURI(){
        return $_SERVER['REQUEST_URI'];
    }

    public function ParseURI($uri){
        $uri = trim ($uri, '/');
        $uri = explode ( "/", $uri);
        return $uri;
    }
}
