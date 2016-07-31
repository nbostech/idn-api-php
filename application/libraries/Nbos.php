<?php

//include_once(APPPATH . "third_party/wavelabs-php-client-api/src/NBOS/Autoloader.php");

class Nbos{

    public $user = null;
    public $auth = null;
    public $social = null;
    public $response = null;
    public static $errors = [];
    public static $fields = [];

    function __construct(){
        //NBOS\Autoloader::register();
        $this->auth = new NBOS\core\Auth();
        $this->user = new NBOS\core\User();
        $this->social = new NBOS\core\Social();
    }

}