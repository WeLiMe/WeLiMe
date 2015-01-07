<?php
/**
 * Created by PhpStorm.
 * User: a4i
 * Date: 1/4/15
 * Time: 2:34 AM
 */

namespace WeLiMe\Repositories;

use PDO;
use WeLiMe\Exceptions\RepositoryExceptions\ConversationNotFoundException;
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
            "INSERT INTO message(`user_id`, `conversation_id`, `content`, `sent_time`) " .
            "VALUES (:userId, :conversationId, :content, :sentTime)"
        );

        $stmt->bindParam(':userId', $message->getUserId(), PDO::PARAM_INT);
        $stmt->bindParam(':conversationId', $message->getConversationId(), PDO::PARAM_INT);
        $stmt->bindParam(':content', $message->getContent(), PDO::PARAM_STR);
        $stmt->bindParam(':sentTime', $message->getSentTime(), PDO::PARAM_STR);

        $stmt->execute();

        $message->setId($this->db->lastInsertId());

        return $message;
    }

    /**
     * @param int $id
     * @param int $messageId
     * @return Message[]
     */
    public function findAllInConversationByIdWithMessageIdGreaterThan($id, $messageId)
    {
        $stmt = $this->db->prepare(
            "SELECT * FROM conversation WHERE `id` = :conversationId LIMIT 1"
        );

        $stmt->bindParam(':conversationId', $id, PDO::PARAM_INT);

        $stmt->execute();

        if ($stmt->rowCount() == 0) throw new ConversationNotFoundException("Conversation not found with id: " . $id . ".");

        $stmt = $this->db->prepare(
            "SELECT * FROM message WHERE `conversation_id` = :conversationId and `id` > :messageId"
        );

        $stmt->bindParam(':conversationId', $id, PDO::PARAM_INT);
        $stmt->bindParam(':messageId', $messageId, PDO::PARAM_STR);

        $stmt->execute();

        $results = $stmt->fetchAll(PDO::FETCH_OBJ);

        $messages = array();

        foreach ($results as $row) {
            $message = new Message(
                $row->id,
                $row->user_id,
                $row->conversation_id,
                $row->content,
                $row->sent_time
            );

            array_push($messages, $message);
        }

        return $messages;
    }
}
