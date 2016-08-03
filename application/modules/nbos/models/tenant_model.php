<?php
/**
 * Created by PhpStorm.
 * User: nbmac4
 * Date: 7/31/16
 * Time: 10:30 AM
 */

class Tenant_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }

    public function isActive($tenantId)
    {

        $query = $this->db->get_where('nbos_tenant', array( 'active'=>1, 'tenant_id' => $tenantId));
        if(count($query->row_array()) > 0) {
            return true;
        }
        return false;
    }
    public function isModuleEnabled($tenantId, $moduleName){
        // call nbos sdk to figure out if tenant is subscribed to module

        if(!$this->isActive($tenantId)){
            // Now we have found that Tenant is not in our local db.
            // We have to connect IDN and figure out if Tenant has subscribed to our module.
            $coreApi = \Nbos\Modules\Ids\IDS::getModuleApi("core");
            $module = $coreApi->hasTenantModules($tenantId, $moduleName);

            if( is_array($module)){

                $data = array(
                    'tenant_id' => $tenantId,
                    'tenant_name' => substr(strstr($tenantId, ":"),1),
                    'active' => 1
                );
                $this->db->insert('nbos_tenant', $data);
                return $this->db->affected_rows() > 0;
            }else{
               return false;
            }
        }
        return true;
    }

}