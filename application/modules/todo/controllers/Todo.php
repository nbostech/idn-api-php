<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Todo extends API_Controller {


    function __construct()
    {

        parent::__construct();

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
                $this->setError("todo.description", "Title empty",'desc');
            }
            // print_r($this->errors);
            if($this->hasErrors()) {
                $this->response_error();
            }else {
                //$this->response_success(array('status'=>true,"message"=>"Data entered successfully"));
                $this->response_internal_error([
                    "messageCode" => "module.server",
                    "message" => "Failed to connect to db. Reconnect after sometime."
                ]);
            }
        }else{
            $this->response_forbidden([
                "messageCode" => "module.user",
                "message" => "Invalid user token"
            ]);
        }
    }
    public function modify_post(){
        $this->response_forbidden([
            "messageCode" => "module.user.unauthorized",
            "message" => "Unauthorized to update others TODO"
        ]);
    }
}