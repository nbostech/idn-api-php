<?php
/**
 * Created by PhpStorm.
 * User: nbmac4
 * Date: 7/14/16
 * Time: 2:50 PM
 */

namespace Nbos\Storage;
use Nbos\Api\ApiContext;
use Nbos\Api\TokenApiModel;


abstract class StorageApiContext implements ApiContext {
    public static $apiContexts = array();
    public  $name;

    public static function registerApiContext($apiContext) {
        self::$apiContexts[$apiContext->getName()] = $apiContext;
    }

    public static function get($name) {
        /*if (!array_key_exist($name, self::$apiContexts)) {
            self::$apiContext[$name] = new InMemoryApiContext();
        }
        */
        return self::$apiContexts[$name];
    }

    public function __construct($name){
        $this->name = $name;
    }
    public function getClientCredentials() {
        return  $this->store["client.credentials"];
    }

    public function setClientCredentials($credentials) {
        $this->store["client.credentials"] = $credentials;
    }

    public  function setClientToken(TokenApiModel $tokenApiModel) {
        $this->store["token.client"] = $tokenApiModel;
    }

    public function getClientToken() {
        return $this->store["token.client"];
    }

    public function getName() { return $this->name; }

    public function setUserToken($moduleName, TokenApiModel $tokenApiModel) {
        $this->tokens[$moduleName] = $tokenApiModel;
        if(!in_array("default",$this->tokens)) {
            $this->tokens["default"] = $tokenApiModel;
        }
    }

    public function getUserToken($moduleName) {
        $tokenApiModel = $this->tokens["moduleName"];
        if($tokenApiModel == null) {
            $tokenApiModel = $this->tokens["default"];
        }
        return $tokenApiModel;
    }

    public function setHost($moduleName, $host) {
        $this->hosts[$moduleName] = $host;
        if(array_key_exists($moduleName, $this->hosts)){
            $this->hosts[$moduleName] = $host;
        }else{
            $this->hosts['default'] = $host;
        }
    }

    public function getHost( $moduleName) {
        if(array_key_exists($moduleName, $this->hosts)){
            return $this->hosts[$moduleName];
        }else{
            return $this->hosts['default'];
        }
    }
    public function isCached($key){ return false; }
}