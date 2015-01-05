<?php
/**
 * Created by PhpStorm.
 * User: a4i
 * Date: 1/4/15
 * Time: 2:34 AM
 */

namespace WeLiMe\Repositories;

use PDO;
use WeLiMe\Models\Entities\Message;
use WeLiMe\PDOConnection;

class MessageRepository
{
    private $db;

    function __construct()
    {
        $this->db = PDOConnection::getConnection();
    }

    /**
     * @param Message $message
     * @return Message
     */
    public function save(Message $message)
    {
        $stmt = $this->db->prepare(
            "INSERT INTO message(`user_id`, `conversation_id`, `content`) " .
            "VALUES (:userId, :conversationId, :content)"
        );

        $stmt->bindParam(':userId', $message->getUserId(), PDO::PARAM_INT);
        $stmt->bindParam(':conversationId', $message->getConversationId(), PDO::PARAM_INT);
        $stmt->bindParam(':content', $message->getContent(), PDO::PARAM_STR);

        $stmt->execute();

        $message->setId($this->db->lastInsertId());

        return $message;
    }
}
