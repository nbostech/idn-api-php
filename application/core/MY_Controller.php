<?php (defined('BASEPATH')) OR exit('No direct script access allowed');


class MY_Controller extends MX_Controller {

    public $theme_name = "default";
    public $header_data = [];

    public function __construct(){
        parent::__construct();
        $this->load->helper('common');

    }

    public function _template($page_name, $data = []){
        $data = $data + $this->header_data;
        setMessage(\NBOS\core\ApiBase::getMessage());
        setFormErrors(\NBOS\core\ApiBase::getErrors());
        setError(\NBOS\core\ApiBase::getError());
        $this->load->view($this->theme_name."/header", $data);
        $this->load->view($this->theme_name."/".$page_name, $data);
        $this->load->view($this->theme_name."/footer");
    }

}