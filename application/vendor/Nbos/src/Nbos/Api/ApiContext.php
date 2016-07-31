<?php
namespace Nbos\Api;

use Nbos\Api\TokenApiModel;

interface ApiContext {

    public function  setHost($moduleName, $host);
    public function  getHost($moduleName);
    public function  getName();


    public function  setClientCredentials($map);
    public function  setClientToken(TokenApiModel $tokenApiModel);

    public function  getClientCredentials();
    public function  getClientToken();

    public function  setUserToken( $moduleName, TokenApiModel $tokenApiModel);
    public function  getUserToken( $moduleName);
}
