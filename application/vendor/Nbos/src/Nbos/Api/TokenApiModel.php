<?php
/**
 * Created by PhpStorm.
 * User: nbmac4
 * Date: 7/14/16
 * Time: 2:35 PM
 */

namespace Nbos\Api;


class TokenApiModel{

    use Serializable;

    private $expires_in;
    private $scope;
    private $token_type;
    private $refresh_token;
    private $access_token;

    public function setData($body, $isArray = false){

        $data = $isArray ? $body : json_decode($body, true);
        $this->expires_in = $data['expires_in'];
        $this->token_type = $data['token_type'];
        $this->access_token = $data['access_token'];
    }

    public function getExpires_in() {
        return $this->expires_in;
    }

    public function getScope() {
        return $this->scope;
    }

    public function getToken_type() {
        return $this->token_type;
    }

    public function getRefresh_token() {
        return $this->refresh_token;
    }

    public function getAccess_token() {
        return $this->access_token;
    }


} 