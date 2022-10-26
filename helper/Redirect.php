<?php

class Redirect{

    public function __construct()
    {}

    public static function redirect($url){
        header("location:" . $url);
        exit();
    }

}


?>