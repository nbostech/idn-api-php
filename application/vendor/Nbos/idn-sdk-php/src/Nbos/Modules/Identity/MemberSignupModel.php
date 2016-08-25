<?php
/**
 * Created by PhpStorm.
 * User: nbmac4
 * Date: 7/27/16
 * Time: 4:52 PM
 */

namespace Nbos\Modules\Identity;

use Nbos\Api\Serializable;

class MemberSignupModel {
    use Serializable;

    private $username;
    private $email;

    private $password;
    private $firstName;
    private $lastName;
    private $jsonAttributes;

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $firstName
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param mixed $jsonAttributes
     */
    public function setJsonAttributes($jsonAttributes)
    {
        $this->jsonAttributes = $jsonAttributes;
    }

    /**
     * @return mixed
     */
    public function getJsonAttributes()
    {
        return $this->jsonAttributes;
    }

    /**
     * @param mixed $lastName
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }


} 