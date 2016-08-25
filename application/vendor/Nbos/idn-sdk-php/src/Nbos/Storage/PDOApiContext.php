<?php
/**
 * Created by PhpStorm.
 * User: nbmac4
 * Date: 7/14/16
 * Time: 2:53 PM
 */

namespace Nbos\Storage;
use Nbos\Api\TokenApiModel;


class PDOApiContext extends StorageApiContext {
    public $store = [];
    public $hosts = [];
    public $tokens = [];
    public $name = null;
    public $db;
    public $cacheDuration ;

    public function __construct($config){

        parent::__construct($config['name']);
        $this->setClientCredentials($config['client.credentials']);
        $this->setHost('default', $config['host']);

        $CI = &get_instance();
        $CI->load->database();
        $this->db = $CI->db;
        $this->cacheDuration = date("Y-m-d H:i:s", strtotime("+1 day"));

    }
    public function isCached($key){
        $query = $this->db->query("SELECT COUNT(*) AS count FROM nbos_cached WHERE field_key = '$key' AND expiry > now() ");
        $row = $query->row();

        return ($row->count > 0);
    }
    public function getCached($key){
        $query = $this->db->query("SELECT field_value  FROM `nbos_cached` WHERE field_key = '$key' ");
        $row = $query->row();

        return $row->field_value;
    }
    public function setCache($key, $value){
        $cacheDuration = date("Y-m-d H:i:s", strtotime("+1 day"));
        $this->db->query("INSERT INTO `nbos_cached` (field_key, field_value, expiry) VALUES ('$key', '$value', '$cacheDuration') ");
        return ($this->db->affected_rows() != 1) ? false : true;
    }


} 