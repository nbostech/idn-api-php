<?php
/**
 * Created by PhpStorm.
 * User: nbmac4
 * Date: 7/27/16
 * Time: 4:29 PM
 */

namespace Nbos\Modules\Identity;


class MemberApiModel {
private $id;
private $email;
private $firstName;
private $lastName;
private $phone;
private $description;
private $uuid;
private $isExternal;
private $socialAccounts;
private $emailConnects;

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

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
     * @param mixed $emailConnects
     */
    public function setEmailConnects($emailConnects)
    {
        $this->emailConnects = $emailConnects;
    }

    /**
     * @return mixed
     */
    public function getEmailConnects()
    {
        return $this->emailConnects;
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
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $isExternal
     */
    public function setIsExternal($isExternal)
    {
        $this->isExternal = $isExternal;
    }

    /**
     * @return mixed
     */
    public function getIsExternal()
    {
        return $this->isExternal;
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
     * @param mixed $phone
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    /**
     * @return mixed
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param mixed $socialAccounts
     */
    public function setSocialAccounts($socialAccounts)
    {
        $this->socialAccounts = $socialAccounts;
    }

    /**
     * @return mixed
     */
    public function getSocialAccounts()
    {
        return $this->socialAccounts;
    }

    /**
     * @param mixed $uuid
     */
    public function setUuid($uuid)
    {
        $this->uuid = $uuid;
    }

    /**
     * @return mixed
     */
    public function getUuid()
    {
        return $this->uuid;
    }


} 