<?php
/**
 * Created by PhpStorm.
 * User: nbmac4
 * Date: 7/31/16
 * Time: 10:30 AM
 */

class Todo_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }


    public function get_tenant_todos($tenantId, $id = 0)
    {
        if ($id === 0)
        {
            $query = $this->db->get_where('todos',array('completed' => 0,'tenant_id' => $tenantId));
            return $query->result_array();
        }

        $query = $this->db->get_where('todos', array('id' => $id, 'tenant_id' => $tenantId));
        return $query->row_array();
    }
    public function get_user_todos($tenantId, $userId, $id = 0)
    {
        if ($id === 0)
        {
            $query = $this->db->get_where('todos',array('completed' => 0,'tenant_id' => $tenantId, 'user_id'=> $userId));
            return $query->result_array();
        }

        $query = $this->db->get_where('todos', array('id' => $id, 'tenant_id' => $tenantId, 'user_id'=> $userId));
        return $query->row_array();
    }

    public function set_todos($id = 0)
    {
        $this->load->helper('url');

        $data = array(
            'title' => $this->input->post('title'),
            'description' => $this->input->post('description'),
        );

        if ($id === 0) {

            return $this->db->insert('todos', $data);

        }
        else {

            $this->db->where('id', $id);
            return $this->db->update('todos', $data);

        }


    }

    public function completed($id)
    {

        $data = array(
            'completed' => 1
        );

        $this->db->where('id', $id);
        $this->db->update('todos', $data);

    }

}