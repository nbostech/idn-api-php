<?php
/**
 * Created by PhpStorm.
 * User: nbmac4
 * Date: 7/21/16
 * Time: 4:10 PM
 */

namespace Nbos\Modules\Ids;


use Nbos\Api\NetworkApi;

class IDS {

    // registry of module classes
    public  static $registry = [];

    // register of moduleApi Instance Objects
    public static $apiInstanceRegistry = [];

    public static function getModuleApi($moduleName, $contextName = "app"){
        if(!array_key_exists($moduleName, self::$registry)){
            //$api = new NetworkApi();
            //$api->setApiContext(AbstractApiContext::get($contextName));
            //TODO:: handle for api

        }else{
            return new self::$registry[$moduleName]();
        }
    }

    public static function register($moduleName, $class){
        self::$registry[$moduleName] = $class;
    }
} 