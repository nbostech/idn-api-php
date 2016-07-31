<?php
/**
 * Created by PhpStorm.
 * User: nbmac4
 * Date: 7/15/16
 * Time: 1:02 PM
 */

namespace Nbos\Api;


class ValidationErrorResponse extends RestMessage {
    private $errors = array();

    public function setErrors($errors){
        $this->errors = $errors;
    }
    public function getErrors(){
        return $this->errors;
    }

} 