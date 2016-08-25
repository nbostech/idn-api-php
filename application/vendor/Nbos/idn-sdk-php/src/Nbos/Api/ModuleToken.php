<?php
/**
 * Created by PhpStorm.
 * User: nbmac4
 * Date: 7/30/16
 * Time: 4:03 PM
 */

namespace Nbos\Api;


interface   ModuleToken {



    //public static function  setTenant($tenantId);
    public  function  getTenantId();
    public  function  getUserId();

    /*
    public function  setUser($username, $memberUUID);

    public function isMember();
    public function isGuest();
    //Check if tenant is active in your local
    public  function isTenantActive();

    // Check if tenant has subscribed to module
    public  function isTenantSubscribedToModule($tenantId);


    public function  setClientId($clientId);
    public function  getClientId();

    public function  setUserToken( $moduleName, TokenApiModel $tokenApiModel);
    public function  getUserToken( $moduleName);
    */


} 