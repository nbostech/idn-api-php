<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Todo extends API_Controller {


    function __construct()
    {
        parent::__construct();

        $this->load->model('nbos/tenant_model','NBOSTenantModel');

        /*
         * Module config
         */
        $config =  include ("./config.php");
        $moduleConfig = $config['moduleApiServer']['todo'];

        $this->moduleToken = new \Nbos\Api\ModuleTokenModel();
        $response = $this->moduleToken->init($this->getBearerToken(), $moduleConfig);

        if($response instanceof \Nbos\Api\SuccessResponse){
            $this->moduleToken->load($response->getMessage());

            //Check if Tenant exist and module  support's requesting tenant
            if(!$this->NBOSTenantModel->isModuleEnabled($this->moduleToken->getTenantId(), $moduleConfig['name'])) {
                $this->response_internal_error([
                    "messageCode" => "module.access",
                    "message" => $this->lang->line('text_module_invalid_tenant')
                ]);
            } 
        }else{
            $this->response_forbidden([
                "messageCode" => "module.access",
                "message" => $this->lang->line('text_module_invalid_requesting_access_token')
            ]);
        }

        $this->load->library('form_validation');
        $this->load->model('todo_model');

    }

    public function index()
    {
        $this->response_error([
            "messageCode" => "todo.endpoint",
            "message" => "Invalid endpoint"
        ]);
    }

    public function list_get(){
        /*
         * GET all todo's across the TENANT
         */
        $data = $this->todo_model->get_tenant_todos($this->moduleToken->getTenantId());
        $this->response_success($data);
    }
    public function mylist_get(){
        /*
         * GET all todo's of Token Member
         */
        if($this->moduleToken->isMember()){

            $data = $this->todo_model->get_user_todos($this->moduleToken->getTenantId(), $this->moduleToken->getUserId());
            $this->response_success($data);
        }else{
            $this->response_error([
                "messageCode" => "todo.user",
                "message" => "Invalid user token"
            ]);
        }
    }
    public function create_post(){

        if($this->moduleToken->isMember()){

            if($this->input->post("title") == ''){
                $this->setError("todo.title", "Title empty",'title');
            }
            if($this->input->post("desc") == ''){
                $this->setError("todo.description", "Title empty",'description');
            }
            // print_r($this->errors);
            if($this->hasErrors()) {
                $this->response_error();
            }else {
                $this->response_success(array("message"=>"Data entered successfully"));
            }
        }else{
            $this->response_forbidden([
                "messageCode" => "todo.user",
                "message" => "Invalid user token"
            ]);
        }
    }
}