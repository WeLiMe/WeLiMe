<?php
/**
 * Created by PhpStorm.
 * User: a4i
 * Date: 1/1/15
 * Time: 8:36 PM
 */

namespace WeLiMe\Models\Entities;

use DateTime;

class Message
{
    /**
     * @var int
     */
    private $id;

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
     * @var string
     */
    private $sentTime;

    /**
     * @param int $id
     * @param int $userId
     * @param int $conversationId
     * @param string $content
     * @param string $sentTime
     */
    function __construct($id = 0, $userId = 0, $conversationId = 0, $content = "", $sentTime = null)
    {
        $this->id = $id;
        $this->userId = $userId;
        $this->conversationId = $conversationId;
        $this->content = $content;
        $this->sentTime = $sentTime;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
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
