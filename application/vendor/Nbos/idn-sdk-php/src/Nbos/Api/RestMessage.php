<?php
/**
 * Created by PhpStorm.
 * User: nbmac4
 * Date: 7/14/16
 * Time: 2:45 PM
 */

namespace Nbos\Api;

class RestMessage {
    public  $messageCode;
    public  $message;
    public function  getMessageCode() {
        return $this->messageCode;
    }

    public function   getMessage() {
        return $this->message;
    }
    public function setMessageCode($code) {
        $this->messageCode = $code;
    }

    public function  setMessage($message) {
         $this->message = $message;
    }
    public function send(){
        return json_encode(get_object_vars($this));
    }

} 