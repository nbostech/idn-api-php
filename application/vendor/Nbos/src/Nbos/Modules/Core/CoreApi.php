<?php
/**
 * Created by PhpStorm.
 * User: nbmac4
 * Date: 7/21/16
 * Time: 10:47 AM
 */

namespace Nbos\Modules\Core;


use Nbos\Api\NetworkApi;

class CoreApi extends NetworkApi {

    public function __construct(){
        parent::__construct();
        $this->setHost("http://api.qa1.nbos.in");
        $this->setModuleName("core");
        $this->setRemoteApiClass("CoreRemoteApi");
    }

    public function hasTenantModules($tenantId, $moduleName){
        $remoteApi = new CoreRemoteApi($this);
        $response =  $remoteApi->getTenantModules($tenantId, $moduleName);

        if($response instanceof \Nbos\Api\SuccessResponse){
            $data = $response->getMessage();

            $modulesList = json_decode($data, true);

            if(count($modulesList) > 0){

                foreach($modulesList as $module){
                    if(strcasecmp($module['name'], $moduleName) == 0){
                        return $module;
                    }
                }
            }
        }
        return false;
    }
} 