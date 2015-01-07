<?php
/**
 * Created by PhpStorm.
 * User: a4i
 * Date: 1/5/15
 * Time: 11:02 PM
 */

namespace WeLiMe\Models\HTMLFormData;

class CreateConversationFormContainer
{
    /** @var string */
    private $initiatorUsername;

    /** @var string */
    private $usernames;

    /**
     * @param string $initiatorUsername
     * @param string $usernames
     */
    function __construct($initiatorUsername = "", $usernames = "")
    {
        $this->initiatorUsername = $initiatorUsername;
        $this->usernames = $usernames;
    }

    /**
     * @return string
     */
    public function getInitiatorUsername()
    {
        return $this->initiatorUsername;
    }

    /**
     * @param string $initiatorUsername
     */
    public function setInitiatorUsername($initiatorUsername)
    {
        $this->initiatorUsername = $initiatorUsername;
    }

    /**
     * @return string
     */
    public function getUsernames()
    {
        return $this->usernames;
    }

    /**
     * @param string $usernames
     */
    public function setUsernames($usernames)
    {
        $this->usernames = $usernames;
    }
}
