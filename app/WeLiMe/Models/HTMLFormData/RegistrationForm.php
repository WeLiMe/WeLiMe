<?php
/**
 * Created by PhpStorm.
 * User: a4i
 * Date: 1/4/15
 * Time: 5:41 AM
 */

namespace WeLiMe\Models\HTMLFormData;

class RegistrationForm
{
    /** @var string */
    private $username;

    /** @var string */
    private $firstName;

    /** @var string */
    private $lastName;

    /** @var string */
    private $email;

    /** @var string */
    private $emailConfirm;

    /** @var string */
    private $password;

    /** @var string */
    private $passwordConfirm;

    /**
     * @param string $username
     * @param string $firstName
     * @param string $lastName
     * @param string $email
     * @param string $emailConfirm
     * @param string $password
     * @param string $passwordConfirm
     */
    function __construct($username = "", $firstName = "", $lastName = "", $email = "", $emailConfirm = "", $password = "", $passwordConfirm = "")
    {
        $this->username = $username;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->emailConfirm = $emailConfirm;
        $this->password = $password;
        $this->passwordConfirm = $passwordConfirm;
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getEmailConfirm()
    {
        return $this->emailConfirm;
    }

    /**
     * @param string $emailConfirm
     */
    public function setEmailConfirm($emailConfirm)
    {
        $this->emailConfirm = $emailConfirm;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function getPasswordConfirm()
    {
        return $this->passwordConfirm;
    }

    /**
     * @param string $passwordConfirm
     */
    public function setPasswordConfirm($passwordConfirm)
    {
        $this->passwordConfirm = $passwordConfirm;
    }
}
