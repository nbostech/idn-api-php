<?php
/**
 * Created by PhpStorm.
 * User: nbmac4
 * Date: 7/14/16
 * Time: 2:38 PM
 */
 namespace Nbos\Api;

trait Serializable
{


    /**
     * Serialize the current object to JSON
     *
     * @return string
     */
    public function toJson()
    {
        return json_encode(get_object_vars($this));
    }
    /**
     * Serialize the current object to JSON
     *
     * @return string
     */
    public function toArray()
    {
        return  get_object_vars($this);
    }
    public function bind($data){

        foreach ($this->toArray() as $name => $oldValue) {
            $this->$name = isset($data[$name]) ? $data[$name] : NULL;
        }
    }



}