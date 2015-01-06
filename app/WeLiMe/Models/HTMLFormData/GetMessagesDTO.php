<?php
/**
 * Created by PhpStorm.
 * User: a4i
 * Date: 1/6/15
 * Time: 6:08 AM
 */

namespace WeLiMe\Models\HTMLFormData;

class GetMessagesDTO {
    /**
     * @var string
     */
    private $firstName;

    /**
     * @var string
     */
    private $lastName;

    /**
     * @var string
     */
    private $content;

    /**
     * @var string
     */
    private $sentTime;

    /**
     * @param string $firstName
     * @param string $lastName
     * @param string $content
     * @param string $sentTime
     */
    function __construct($firstName = "", $lastName = "", $content = "", $sentTime = "")
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->content = $content;
        $this->sentTime = $sentTime;
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
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param string $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * @return string
     */
    public function getSentTime()
    {
        return $this->sentTime;
    }

    /**
     * @param string $sentTime
     */
    public function setSentTime($sentTime)
    {
        $this->sentTime = $sentTime;
    }
}