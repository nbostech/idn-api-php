<?php
/**
 * Created by PhpStorm.
 * User: nbmac4
 * Date: 7/14/16
 * Time: 2:53 PM
 */

namespace Nbos\Api;

use Nbos\Api\TokenApiModel;

class SessionApiContext extends AbstractApiContext {
    public $store = [];
    public $hosts = [];
    public $tokens = [];
    public $name= null;

    public function __construct($config){

        parent::__construct($config['name']);
        $name = $config['name'];

        if(!array_key_exists($name, $_SESSION))
            $_SESSION[$config['name']] = array('tokens'=>[],'hosts'=>[]);

         // echo '<pre>';        print_r($_SESSION);exit;

         //$_SESSION = array();

        $this->setClientCredentials($config['client.credentials']);
        $this->setHost($name, $config['host']);
    }

    public function getClientCredentials() {
        return  $this->store["client.credentials"];
    }

    public function setClientCredentials($credentials) {
        $this->store["client.credentials"] = $credentials;

    }

    public  function setClientToken(TokenApiModel $tokenApiModel) {

        $tokens = $this->getData('tokens');
        $tokens['client_token'] = $tokenApiModel;
        $this->setData('tokens', $tokens);
    }

    public function getClientToken() {
        $tokens = $this->getData('tokens');
        return $tokens['client_token'];
    }

    public function getName() { return $this->name;  }

    public function setUserToken($moduleName, TokenApiModel $tokenApiModel) {

        $tokens = $this->getData('tokens');
        $tokens[] = array($moduleName.'user_token' => $tokenApiModel);
        $this->setData('tokens', $tokens);
    }

    public function getUserToken($moduleName) {
        $tokens = $this->getData('tokens');
        return $tokens[$moduleName.'client_token'];
    }

    public function setHost($moduleName, $host) {
        $hosts = $this->getData('hosts');
        $hosts[$moduleName] =  $host;
        $this->setData('hosts', $hosts);
    }

    public function getHost( $moduleName) {
        $tokens = $this->getData('hosts');
        return $tokens[$moduleName];
    }
    public function setData($key, $value,$name = ''){
        if($name == '')
            $name = $this->getName();

        $_SESSION[$name][$key] = $value;
    }
    public function getData($key, $name = ''){
        if($name == '')
            $name = $this->getName();

        return $_SESSION[$name][$key];
    }
} 