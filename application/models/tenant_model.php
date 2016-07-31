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

        $query = $this->db->get_where('nbos_module_todo', array( 'active'=>1, 'tenant_id' => $tenantId));
        if(count($query->row_array()) > 0) {
            return true;
        }
        return false;
    }
    public function isEnabled($tenantId){
        return true;
        //TODO:: This is purely module based business logic

        // If TENANT is not found in local db, then RETURN false
        // if TENANT is found but inactive due to subscription or some other reasons then RETURN false

    }

}