<?php
/**
 * Created by PhpStorm.
 * User: nbmac4
 * Date: 7/30/16
 * Time: 4:03 PM
 */

namespace Nbos\Api;


class ModuleTokenModel implements   ModuleToken {

    public $tenantId;
    public $username;
    public $memberId = null;
    public $authorities = [];
    public $modules = [];

    public function __construct(){

        \Nbos\Modules\Ids\IDS::register("identity", '\Nbos\Modules\Identity\IdentityApi');
        \Nbos\Modules\Ids\IDS::register("core", '\Nbos\Modules\Core\CoreApi');
    }
    function init($bearerToken, $moduleConfig)
    {
        $storage = $moduleConfig['storage'];
        switch ($storage) {
            case 'PDO':
                        \Nbos\Storage\StorageApiContext::registerApiContext(new \Nbos\Storage\PDOApiContext($moduleConfig));
                        break;
            default:
                    \Nbos\Storage\StorageApiContext::registerApiContext(new \Nbos\Api\InMemoryApiContext($moduleConfig));
                    break;
        }

        $identity = \Nbos\Modules\Ids\IDS::getModuleApi("identity");

        $response = $identity->validateRequest($bearerToken, $moduleConfig['name'], $moduleConfig['key']);

        return $response;
    }

    function load($data)
    {
        $data = json_decode($data,true);
        /*
         * Sample Json:
         * {
              "username": "ujohon",
              "clientId": "sers-app-client",
              "tokenType": "bearer",
              "token": "dc55186f-d307-45a4-9774-1fd8523712ad",
              "expiration": "2016-10-03T07:21:32Z",
              "expired": false,
              "member": {
                "uuid": "MBR:a131cc78-4a19-4ea6-aef6-72de8e0745ab"
              },
              "authorities": [],
              "tenantId": "TNT:tets",
              "modules": []
            }
         */
        $this->tenantId = $data['tenantId'];
        $this->username = $data['username'];
        if($this->username != '') {
            $this->memberId = $data['member']['uuid'];
        }

    }

    public function  getTenantId(){
        return $this->tenantId;
    }
    public function isMember(){
        return  $this->memberId !== null ? true:false;
    }
    public function  getUserId(){
        return $this->memberId;
    }


    //TODO:: Check if user already exist in your local db otherwise add into table : username and member.uuid

    //TODO: set UserObject


    /* TODO::
     * 1) Check if Tenant is active in master table of yours. If active continue to serve request
     * 2) if Tenant is not in master table of yours, then either reject request with error
     * Or Create a new record in your table             *
     */

    //TODO:: if your module exist in this array, it means its subsribed

} 