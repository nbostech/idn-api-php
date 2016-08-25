<?php

require APPPATH . '/libraries/REST_Controller.php';

/**
 * Class BaseApi
 */
class API_Controller extends REST_Controller
{
    public $errors = [];
    public $moduleToken;

    /**
     * @throws Exception
     */
    function __construct()
    {
        // Construct the parent class
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

        if (isset($_GET['clientId'])) {
            $_GET['client_id'] = $_GET['clientId'];
            $_POST['client_id'] = $_GET['clientId'];
        }
        if (isset($_POST['clientId'])) {
            $_POST['client_id'] = $_POST['clientId'];
            $_GET['client_id'] = $_POST['clientId'];
        }
       // $this->load->library('form_validation');
      //  $this->form_validation->CI =& $this;

    }


    function getBearerToken(){

        $header = $this->header("Authorization");
        $access_tokenArray = explode(" ", $header);

        return (count($access_tokenArray) == 2 ) ? trim($access_tokenArray[1]):false;

    }


    /**
     * @param null $message
     * @param array $data
     * @param int $http_status
     */
    function success_send($data = [], $message = null, $http_status = REST_Controller::HTTP_ACCEPTED)
    {
        $data = array('success' => true, 'message' => $message, 'data' => $data);
        $this->set_response($data, $http_status);
    }


    /**
     * @param null $message
     * @param array $data
     * @param int $http_status
     */
    function error_send($data = [], $message = null, $http_status = REST_Controller::HTTP_ACCEPTED)
    {
        $data = array('success' => false, 'error_message' => $message, 'data' => $data);
        $this->set_response($data, $http_status);
    }

    function parseURLToken($url)
    {
        $token = [];
        $token_str = parse_url($url);
        $token_str = !empty($token_str['fragment']) ? $token_str['fragment'] : "";
        $token_str = explode("&", $token_str);
        foreach ($token_str as $slide) {
            $slide = explode("=", $slide);
            if (!empty($slide[0]))
                $token[$slide[0]] = $slide[1];
        }
        return $token;
    }

    public function setError($messageCode,$message="",  $field = "", $objectName ='')
    {
        if(empty($message)) $message = $messageCode;
        $this->errors[] = [
            "messageCode" => $messageCode,
            "message" => $message,
            "propertyName" => $field,
            "objectName" => $objectName
        ];
       // $this->set_response_error(['errors' => $this->errors]);
    }
    public function hasErrors(){

        return (count($this->errors) > 0 ? true : false);
    }

    function set_response_success($data = [])
    {
        // HTTP 200
        $this->set_response($data, REST_Controller::HTTP_OK);
    }

    function set_response_error($data = [])
    {
        // HTTP 400
        $this->set_response($data, REST_Controller::HTTP_BAD_REQUEST);
    }

    function set_response_not_found($data = [])
    {
        // HTTP 404
        $this->set_response($data, REST_Controller::HTTP_NOT_FOUND);
    }

    function set_response_forbidden($data = [])
    {
        // HTTP 403
        $this->set_response($data, REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
    }

    function set_response_invalid_method($data = [])
    {
        // HTTP 405
        $this->set_response($data, REST_Controller::HTTP_METHOD_NOT_ALLOWED);
    }

    function set_response_internal_error($data = [])
    {
        // HTTP 500
        $this->set_response($data, REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
    }

    function response_success($data = [])
    {
        // HTTP 200
        $this->response($data, REST_Controller::HTTP_OK);
    }

    function response_error($data = [])
    {
        // HTTP 400
        if (empty($data)) {
            $data["errors"] = $this->errors;
        }
        $this->response($data, REST_Controller::HTTP_BAD_REQUEST);
    }

    function response_not_found($data = [])
    {
        // HTTP 404
        $this->response($data, REST_Controller::HTTP_NOT_FOUND);
    }

    function response_forbidden($data = [])
    {
        // HTTP 403
        $this->response($data, REST_Controller::HTTP_FORBIDDEN);
    }

    function response_invalid_method($data = [])
    {
        // HTTP 405
        $this->response($data, REST_Controller::HTTP_METHOD_NOT_ALLOWED);
    }

    function response_internal_error($data = [])
    {
        // HTTP 500
        $this->response($data, REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
    }

}