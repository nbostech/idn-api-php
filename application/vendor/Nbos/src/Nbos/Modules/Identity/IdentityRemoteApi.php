<?php
/**
 * Created by PhpStorm.
 * User: nbmac4
 * Date: 7/21/16
 * Time: 10:48 AM
 */

namespace Nbos\Modules\Identity;


use Nbos\Api\SuccessResponse;
use Nbos\Api\TokenApiModel;

class IdentityRemoteApi {
    public $baseIdentityUrl = "/api/identity/v0";
    public $tokenUrl = "oauth/token";

    public $loginUrl;
    public $signupUrl;
    public $connectUrl;
    public $authorizeUrl ;
    public $profileUrl;
    public $forgotUrl;
    public $changeUrl;
    public $logoutUrl;
    public $socialLoginUrl;

    public function __construct($httpClient) {
        $this->httpClient = $httpClient;

        $this->loginUrl = $this->baseIdentityUrl . "/auth/login";
        $this->signupUrl = $this->baseIdentityUrl ."/users/signup";
        $this->connectUrl = $this->baseIdentityUrl ."/auth/social/{connectService}/connect";
        $this->authorizeUrl = $this->baseIdentityUrl ."/auth/social/{authorizeService}/authorize";
        $this->profileUrl = $this->baseIdentityUrl . "/users/{uuid}";
        $this->forgotUrl = $this->baseIdentityUrl ."/auth/forgotPassword";
        $this->changeUrl = $this->baseIdentityUrl ."/auth/changePassword";
        $this->logoutUrl = $this->baseIdentityUrl ."/auth/logout";
        $this->socialLoginUrl = $this->baseIdentityUrl ."/auth/social/{loginService}/login";

        $this->tokenVerifyUrl =   "api/oauth/v0/tokens";

   }
    public function getToken(){

        $apiContext =  \Nbos\Api\SessionApicontext::get("app");

        $body = array(
                        "client_id" => $apiContext->getClientCredentials()['client'],
                        "client_secret" => $apiContext->getClientCredentials()['secret'],
                        "grant_type" => "client_credentials"
                    );

        $response =  $this->httpClient->post($this->tokenUrl, $body);
        if($response instanceof \Nbos\Api\SuccessResponse){
            $token = new TokenApiModel();
            //$token->setData($response->getBody()->getContents());
            $token->setData($response->getMessage());
            $apiContext->setClientToken($token);
        }

        return $token->toJson();

    }
    public function getModuleToken($moduleName){

        $apiContext =  \Nbos\Storage\StorageApiContext::get($moduleName);

        if($apiContext->isCached('ModuleToken'.$moduleName)) {

            $token = new TokenApiModel();
            $token->setData($apiContext->getCached('ModuleToken'.$moduleName));
            $apiContext->setClientToken($token);
            return true;
        }else{
            $body = array(
                "client_id" => $apiContext->getClientCredentials()['client'],
                "client_secret" => $apiContext->getClientCredentials()['secret'],
                "grant_type" => "client_credentials",
                "scope" => "scope:oauth.token.verify"
            );

            $response =  $this->httpClient->post($this->tokenUrl, $body);
            if($response instanceof \Nbos\Api\SuccessResponse){
                $token = new TokenApiModel();
                //$token->setData($response->getBody()->getContents());
                $token->setData($response->getMessage());
                $apiContext->setClientToken($token);
                $apiContext->setCache('ModuleToken'.$moduleName, $response->getMessage());
                return true;
            }
        }

        return false;

    }
    public function validateRequest($bearerToken, $moduleName, $moduleKey){

        $apiContext =  \Nbos\Storage\StorageApiContext::get($moduleName);
        if($this->getModuleToken($moduleName)) {

            if($apiContext->isCached('Token:'.$bearerToken)) {
                $response = new \Nbos\Api\SuccessResponse();
                $response->setMessage($apiContext->getCached('Token:'.$bearerToken));
                return $response;
            }else{
                $response =  $this->httpClient->get($this->tokenVerifyUrl."/".$bearerToken, '',true, '', $moduleName, $moduleKey);
                if($response instanceof \Nbos\Api\SuccessResponse){
                    $data = json_decode($response->getMessage(),true);
                    /*
                     * Check if token expired
                     */
                    if($data['expired'] == true or $data['expired'] === ''){
                        $resp = new ValidationErrorResponse();
                        $resp->setMessage('Token expired');
                        return $resp;
                    }
                    $apiContext->setCache('Token:'.$bearerToken, $response->getMessage());
                }
            }

            return $response;
        }

    }
    public function login($loginModel){

        $bodyRaw = $loginModel->toArray();

        $response =  $this->httpClient->post($this->loginUrl, $bodyRaw, true,'json');

        if($response instanceof \Nbos\Api\SuccessResponse){
            // Success handler
            $responseData =  json_decode($response->getMessage(), true);

            $apiContext =  \Nbos\Api\SessionApicontext::get("app");

            $token = new TokenApiModel();
            $token->setData($responseData['token'], true);
            $apiContext->setUserToken("identity", $token);
            //TODO:: Set user model
        }

        return $response;

    }
    public function signup($signUpModel){
        $bodyRaw = $signUpModel->toArray();

        $response =  $this->httpClient->post($this->signupUrl.'sd', $bodyRaw, true,'json');

        if($response instanceof \Nbos\Api\SuccessResponse){
             // Success handler
        }else if($response instanceof \Nbos\Api\ValidationErrorResponse){
            // error handler
        }else{
            // invalid error handler
        }
        return $response;
    }

} 