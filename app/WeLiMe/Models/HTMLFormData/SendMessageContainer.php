<?php
/**
 * Created by PhpStorm.
 * User: a4i
 * Date: 1/5/15
 * Time: 8:37 PM
 */

namespace WeLiMe\Models\HTMLFormData;

class SendMessageContainer
{
    /**
     * @var int
     */
    private $userId;

    /**
     * @var int
     */
    private $conversationId;

    /**
     * @var string
     */
    private $content;

    /**
     * @param int $userId
     * @param int $conversationId
     * @param string $content
     */
    function __construct($userId = 0, $conversationId = 0, $content = "")
    {
        $this->userId = $userId;
        $this->conversationId = $conversationId;
        $this->content = $content;
    }

    /**
     * @return int
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @param int $userId
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

    /**
     * @return int
     */
    public function getConversationId()
    {
        return $this->conversationId;
    }

    /**
     * @param int $conversationId
     */
    public function setConversationId($conversationId)
    {
        $this->conversationId = $conversationId;
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
}
