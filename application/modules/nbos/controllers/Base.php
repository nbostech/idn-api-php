<?php
defined('BASEPATH') OR exit('No direct script access allowed');



class Base extends API_Controller {

    function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->response_error([
            "messageCode" => "module.endpoint",
            "message" => "Invalid endpoint"
        ]);
    }
    public function notfound()
    {
        $this->response_not_found([
            "messageCode" => "module.endpoint",
            "message" => "Invalid endpoint"
        ]);
    }
    public function invalidmethod()
    {
        $this->response_invalid_method([
            "messageCode" => "module.endpoint",
            "message" => "Invalid REQUEST Method"
        ]);
    }
    public function internalerror()
    {
        $this->response_internal_error([
            "messageCode" => "module.endpoint",
            "message" => "Invalid REQUEST Method"
        ]);
    }

}