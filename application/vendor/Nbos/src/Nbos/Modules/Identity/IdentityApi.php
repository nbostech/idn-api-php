<?php
/**
 * Created by PhpStorm.
 * User: nbmac4
 * Date: 7/21/16
 * Time: 10:47 AM
 */

namespace Nbos\Modules\Identity;


use Nbos\Api\NetworkApi;

class IdentityApi extends NetworkApi {

    public function __construct(){
        parent::__construct();
        $this->setHost("http://api.qa1.nbos.in");
        $this->setModuleName("identity");
        $this->setRemoteApiClass("IdentityRemoteApi");
    }

    public function getClientToken(){
        $remoteApi = new IdentityRemoteApi($this);
        return $remoteApi->getToken();
    }

    public function validateRequest($bearerToken, $moduleName, $moduleKey){
        $remoteApi = new IdentityRemoteApi($this);
        return $remoteApi->validateRequest($bearerToken, $moduleName, $moduleKey);
    }

    public function login($username, $password){
        $loginModel = new LoginModel();
        $loginModel->setPassword($password);
        $loginModel->setUsername($username);

        $remoteApi = new IdentityRemoteApi($this);
        return $remoteApi->login($loginModel);
    }
    public function signup($data){
        $signUpModel = new MemberSignupModel();
        $signUpModel->bind($data);

        $remoteApi = new IdentityRemoteApi($this);
        return $remoteApi->signup($signUpModel);
    }

} 