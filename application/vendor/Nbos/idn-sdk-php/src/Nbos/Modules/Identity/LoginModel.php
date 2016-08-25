<?php
/**
 * Created by PhpStorm.
 * User: nbmac4
 * Date: 7/26/16
 * Time: 5:37 PM
 */

namespace Nbos\Modules\Identity;
use Nbos\Api\Serializable;

class LoginModel {
    use Serializable;
    public function getUsername() {
        return $this->username;
    }

    public function setUsername($username) {
        $this->username = $username;
    }

    public function getPassword() {
        return $this->password;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public $username;
    public $password;
} 