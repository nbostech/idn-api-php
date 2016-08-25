<?php
/**
 * Created by PhpStorm.
 * User: nbmac4
 * Date: 7/21/16
 * Time: 10:48 AM
 */

namespace Nbos\Modules\Core;


use Nbos\Api\SuccessResponse;
use Nbos\Api\TokenApiModel;

class CoreRemoteApi {
    public $baseCoreUrl = "/api/core/v0";

    public $tokenModulesUrl;

    public function __construct($httpClient) {
        $this->httpClient = $httpClient;

        $this->tokenModulesUrl = $this->baseCoreUrl . "/tenants/TNT:hariome/modules";

   }
    public function getTenantModuleUrl($tenantId){
        return $this->baseCoreUrl . "/tenants/".$tenantId."/modules";
    }
    public function getTenantModules($tenantId, $moduleName){
        return $this->httpClient->get($this->getTenantModuleUrl($tenantId), '', true, '', $moduleName);
    }
} 